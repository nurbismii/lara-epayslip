<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKaryawan;
use App\Models\User;
use App\Models\InfoPengumuman;
use App\Models\KomponenGaji;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (Auth::user()->level == 'Administrator') {
            $user_aktif = User::where('level', 'Pengguna')->where('status', 'Aktif')->count();

            $user_nonaktif = User::where('level', 'Pengguna')->where('status', 'Tidak Aktif')->count();

            $karyawan = DB::table('data_karyawans')->where('status_karyawan', null)->count();

            $list_queue = DB::table('jobs')->count();

            $gaji = KomponenGaji::select('periode', 'gaji_pokok')->get();

            $tahun_sekarang = $request->tahun != '' ? $request->tahun : date('Y', strtotime(Carbon::now()));

            $tahun_lalu = $tahun_sekarang - 1;

            $total_payroll = getDataPayroll($gaji, $tahun_sekarang);

            $total_payroll_tahun_lalu = getDataPayroll($gaji, $tahun_lalu);

            $total_karyawan = getTotalKaryawan($gaji, $tahun_sekarang);

            $total_karyawan_tahun_lalu = getTotalKaryawan($gaji, $tahun_lalu);

            $rerata_upah = rerataUpah($total_payroll, $total_karyawan);

            $rerata_upah_tahun_lalu = rerataUpah($total_payroll_tahun_lalu, $total_karyawan_tahun_lalu);

            $persentase_selisih_karyawan = persenSelisihKaryawan($total_karyawan, $total_karyawan_tahun_lalu);

            $selisih_karyawan = selisihKaryawan($total_karyawan, $total_karyawan_tahun_lalu);

            $persentase = getPersentase($total_payroll_tahun_lalu, $total_payroll);

            $selisih = getSelisih($total_payroll_tahun_lalu, $total_payroll);

            $pengumuman = InfoPengumuman::orderBy('id', 'DESC')->limit(4)->get();

            return view('home.admin', compact('rerata_upah_tahun_lalu', 'rerata_upah', 'selisih_karyawan', 'persentase_selisih_karyawan', 'total_karyawan', 'total_karyawan_tahun_lalu', 'selisih', 'user_aktif', 'persentase', 'tahun_sekarang', 'tahun_lalu', 'list_queue', 'total_payroll', 'total_payroll_tahun_lalu', 'user_nonaktif', 'karyawan', 'pengumuman'));
        }

        $user_aktif = User::where('level', 'Pengguna')->where('status', 'Aktif')->count();

        $user_nonaktif = User::where('level', 'Pengguna')->where('status', 'Tidak Aktif')->count();

        $karyawan = DB::table('data_karyawans')->count();

        $list_queue = DB::table('jobs')->count();

        $pengumuman = InfoPengumuman::orderBy('id', 'ASC')->limit(4)->get();

        $post_pengumuman = InfoPengumuman::where('description', '!=', null)->orderBy('id', 'DESC')->limit(4)->get();

        return view('home.index', compact('user_aktif', 'post_pengumuman', 'list_queue', 'user_nonaktif', 'karyawan', 'pengumuman'));
    }

    public function masaKerja(Request $request)
    {
        $data_karyawan = DataKaryawan::where('status_karyawan', NULL)
            ->select(
                DB::raw('FLOOR(DATEDIFF(CURRENT_DATE, tgl_join) / 365) as years_worked'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('years_worked')
            ->having('years_worked', '>=', 1)
            ->get();

        if ($request->filled('periode')) {
            $req_tahun = date('Y', strtotime($request->periode));
            $req_bulan = date('m', strtotime($request->periode));
        } else {
            $req_tahun = date('Y', strtotime(Carbon::now()));
            $req_bulan = date('m', strtotime(Carbon::now()));
        }

        $tahun_lalu = $req_tahun - 1;
        $tahun_lalu_min1 = $tahun_lalu - 1;
        $periode_saat_ini = $req_tahun . '-' . $req_bulan;
        $periode_tahun_lalu = $tahun_lalu . '-' . $req_bulan;
        $periode_tahun_lalu_min1 = $tahun_lalu_min1 . '-' . $req_bulan;

        $data_masa_kerja = fetchMasaKerjaByPeriode($periode_saat_ini);
        $data_masa_kerja_tahun_lalu = fetchMasaKerjaByPeriode($periode_tahun_lalu);
        $data_masa_kerja_tahun_lalu_min1 = fetchMasaKerjaByPeriode($periode_tahun_lalu_min1);

        $grand_total_mk = fetchSumMasaKerjaByPeriode($periode_saat_ini);
        $grand_total_mk_tahun_lalu = fetchSumMasaKerjaByPeriode($periode_tahun_lalu);
        $grand_total_mk_tahun_lalu_min1 = fetchSumMasaKerjaByPeriode($periode_tahun_lalu_min1);
        $grand_total_mk = array_merge($grand_total_mk_tahun_lalu_min1, $grand_total_mk_tahun_lalu, $grand_total_mk);

        $jumlah_mk_penerima_upah = jumlahKaryawanGrupByMasaKerja($data_masa_kerja);
        $jumlah_mk_penerima_upah_tahun_lalu = jumlahKaryawanGrupByMasaKerja($data_masa_kerja_tahun_lalu);
        $jumlah_mk_penerima_upah_tahun_lalu_min1 = jumlahKaryawanGrupByMasaKerja($data_masa_kerja_tahun_lalu_min1);

        $total_bayar_masa_kerja = totalBayarGrupByMasaKerja($data_masa_kerja);
        $total_bayar_masa_kerja_tahun_lalu = totalBayarGrupByMasaKerja($data_masa_kerja_tahun_lalu);

        $persentase = persentase($total_bayar_masa_kerja, $total_bayar_masa_kerja_tahun_lalu);

        $label_masa = labelKaryawanGrupByMasaKerja($data_karyawan);

        $jumlah_masa_kerja = jumlahKaryawanGrupByMasaKerja($data_karyawan);

        return view('home.masa-kerja', compact('grand_total_mk', 'persentase', 'total_bayar_masa_kerja', 'total_bayar_masa_kerja_tahun_lalu', 'jumlah_mk_penerima_upah_tahun_lalu_min1', 'jumlah_mk_penerima_upah_tahun_lalu_min1', 'periode_tahun_lalu_min1', 'periode_tahun_lalu', 'periode_saat_ini', 'data_masa_kerja', 'data_masa_kerja_tahun_lalu', 'jumlah_mk_penerima_upah', 'jumlah_mk_penerima_upah_tahun_lalu', 'label_masa', 'jumlah_masa_kerja'));
    }

    public function BPJSTK(Request $request)
    {
        if ($request->filled('periode')) {
            $req_tahun = date('Y', strtotime($request->periode));
        } else {
            $req_tahun = date('Y', strtotime(Carbon::now()));
        }

        $periode_saat_ini = $req_tahun;
        $periode_tahun_lalu = $req_tahun - 1;

        $data_bpjs_tk = fetchBpjsTkByPeriode((int)$periode_saat_ini);
        $data_bpjs_tk_tahun_lalu = fetchBpjsTkByPeriode($periode_tahun_lalu);

        $data_jumlah_karyawan_jht = jumlahKaryawanJht($data_bpjs_tk);
        $data_jumlah_karyawan_jht_thn_lalu = jumlahKaryawanJht($data_bpjs_tk_tahun_lalu);

        $data_bpjs_tk = jumlahPembayaranJht($data_bpjs_tk);
        $data_bpjs_tk_tahun_lalu = jumlahPembayaranJht($data_bpjs_tk_tahun_lalu);

        return view('home.bpjs-tk', compact('data_jumlah_karyawan_jht_thn_lalu', 'data_jumlah_karyawan_jht', 'data_bpjs_tk_tahun_lalu', 'data_bpjs_tk', 'periode_saat_ini', 'periode_tahun_lalu'));
    }

    public function fetchMasaKerja(Request $request)
    {
        $data = KomponenGaji::select('periode', DB::raw('FLOOR(tunj_mk / 50000) as years_worked'), DB::raw('COUNT(*) as count'), DB::raw('SUM(tunj_mk) as total_tunj_mk'))
            ->groupBy('periode', 'years_worked')
            ->having('years_worked', '>=', 1);

        return DataTables::of($data)
            ->addIndexColumn()
            ->filter(function ($instance) use ($request) {
                if ($request->periode != '') {
                    $instance->where('periode', $request->periode);
                }
                if ($request->years != '') {
                    $instance->having('years_worked', '=', $request->years);
                }
            })->make(true);
    }
}
