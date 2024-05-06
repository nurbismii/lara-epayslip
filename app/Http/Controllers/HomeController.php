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
    public function index()
    {
        if (Auth::user()->level == 'Administrator') {
            $user_aktif = User::where('level', 'Pengguna')->where('status', 'Aktif')->count();

            $user_nonaktif = User::where('level', 'Pengguna')->where('status', 'Tidak Aktif')->count();

            $karyawan = DB::table('data_karyawans')->where('status_karyawan', null)->count();

            $list_queue = DB::table('jobs')->count();

            $gaji = KomponenGaji::select('periode', 'tot_diterima')->get();

            $tahun_sekarang = date('Y', strtotime(Carbon::now()));

            $tahun_lalu = date('Y', strtotime("$tahun_sekarang -1 Year"));

            $total_payroll = getDataPayroll($gaji, $tahun_sekarang);

            $total_payroll_tahun_lalu = getDataPayroll($gaji, $tahun_lalu);

            $persentase = getPersentase($total_payroll_tahun_lalu, $total_payroll);

            $pengumuman = InfoPengumuman::orderBy('id', 'DESC')->limit(4)->get();

            return view('home.admin', compact('user_aktif', 'persentase', 'tahun_sekarang', 'tahun_lalu', 'list_queue', 'total_payroll', 'total_payroll_tahun_lalu', 'user_nonaktif', 'karyawan', 'pengumuman'));
        }

        $user_aktif = User::where('level', 'Pengguna')->where('status', 'Aktif')->count();

        $user_nonaktif = User::where('level', 'Pengguna')->where('status', 'Tidak Aktif')->count();

        $karyawan = DB::table('data_karyawans')->count();

        $list_queue = DB::table('jobs')->count();

        $pengumuman = InfoPengumuman::orderBy('id', 'ASC')->limit(4)->get();

        $post_pengumuman = InfoPengumuman::where('description', '!=', null)->orderBy('id', 'DESC')->limit(4)->get();

        return view('home.index', compact('user_aktif', 'post_pengumuman', 'list_queue', 'user_nonaktif', 'karyawan', 'pengumuman'));
    }
}
