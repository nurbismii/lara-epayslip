<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKaryawan;
use App\Models\KomponenGaji;
use App\Imports\DataKaryawans;
use App\Imports\PerubahanKaryawan;
use App\Imports\HapusKaryawan;
use Carbon\Carbon;
use Yajra\DataTables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class KaryawanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            if ((Auth::user()->level == "Administrator")) {
                $data = DataKaryawan::select('*');
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    if (Auth::user()->level == "Administrator") {
                        return view('karyawan._aksi', [
                            'data' => $data,
                            'edit' => route('karyawan.edit', $data->id),
                            'show' => route('karyawan.show', $data->id),
                            'destroy' => route('karyawan.destroy', $data->id),
                        ]);
                    }
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->where('nama', 'LIKE', "%$search%");
                            $w->Orwhere('nik', 'LIKE', "%$search%");
                            $w->Orwhere('no_ktp', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('karyawan.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'nik' => $request['nik'],
            'no_ktp' => $request['no_ktp'],
            'nama' => $request['nama'],
            'tgl_lahir' => $request['tgl_lahir'],
            'nm_perusahaan' => $request['nm_perusahaan'],
            'npwp' => $request['npwp'],
            'bpjs_ket' => $request['bpjs_ket'],
            'bpjs_tk' => $request['bpjs_tk'],
            'vaksin_1' => $request['vaksin_1'],

            'tgl_join' => $request['tgl_join'],

        ];
        $cek = DataKaryawan::where('nik', $request['nik'])
            ->orWhere('no_ktp', $request['no_ktp'])
            ->first();
        if ($cek === Null) {
            return DataKaryawan::create($data);
        } else {
            return DataKaryawan::create($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if (Auth::user()->level == "Administrator") {

            $data = KomponenGaji::with('karyawan')->where('data_karyawan_id', $id)->latest()->first();

            $data_cuti = DB::connection('mysql_hris')->table('employees')->select('sisa_cuti', 'sisa_cuti_covid', 'entry_date')->where('nik', $data->karyawan->nik)->first();

            if (!$data_cuti) {
                $tahun_sekarang = date('Y', strtotime(Carbon::now()));

                $tanggal_masuk = date('m-d', strtotime($data->tgl_join));

                $jatuh_tempo = date('Y-m-d', strtotime($tahun_sekarang . '-' .  $tanggal_masuk));

                if ($jatuh_tempo < Carbon::now()) {
                    $jatuh_tempo = date('Y-m-d', strtotime('+1 year', strtotime($tahun_sekarang . '-' .  $tanggal_masuk)));
                }

                $jatuh_tempo = Carbon::now()->diffInDays($jatuh_tempo);
            }

            $tahun_sekarang = date('Y', strtotime(Carbon::now()));

            $tanggal_masuk = date('m-d', strtotime($data_cuti->entry_date));

            $jatuh_tempo = date('Y-m-d', strtotime($tahun_sekarang . '-' .  $tanggal_masuk));

            if ($jatuh_tempo < Carbon::now()) {
                $jatuh_tempo = date('Y-m-d', strtotime('+1 year', strtotime($tahun_sekarang . '-' .  $tanggal_masuk)));
            }

            $jatuh_tempo = Carbon::now()->diffInDays($jatuh_tempo);git 

            return view('karyawan.show', compact('data', 'data_cuti', 'jatuh_tempo'));
        }
        Alert::error('Oppps', 'Kamu tidak dapat mengakses halaman ini');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->level == "Administrator") {
            $data = DataKaryawan::findOrFail($id);
            return view('karyawan.edit', compact('data'));
        }
        Alert::error('Oppps', 'Kamu tidak dapat mengakses halaman ini');
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            if (Auth::user()->level == "Administrator") {

                DataKaryawan::where('id', $id)->update([
                    'nik' => $request->nik,
                    'no_ktp' => $request->no_ktp,
                    'nama' => $request->nama,
                    'nm_perusahaan' => $request->nm_perusahaan,
                    'tgl_lahir' => $request->tgl_lahir,
                    'npwp' => $request->npwp,
                    'bpjs_ket' => $request->bpsj_ket,
                    'bpjs_tk' => $request->bpjs_tk,
                    'vaksin_1' => $request->vaksin_1,
                    'tgl_join' => $request->tgl_join,
                ]);

                Alert::success('Berhasil', 'Data berhasil diperbarui');
                return redirect('karyawan');
            }
        } catch (\Throwable $e) {
            Alert::error('Oppss', 'Terjadi kesalahan pada permintan pembaruan');
            return redirect('karyawan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->level == "Administrator") {
            DataKaryawan::destroy($id);
        } else {
            Alert::error('Gagal', 'Oops, Hayoo Mau ngapain ???');
            return redirect()->route('warga.index');
        }
    }

    public function api()
    {
        $nmr = '1';
        $karyawan = DataKaryawan::all();
        return Datatables::of($karyawan)
            ->addColumn('action', function ($karyawan) {
                if (Auth::user()->level == "Administrator") {
                    return
                        '<a onclick="edit_karyawan(' . $karyawan->id . ')"  class="btn btn-outline-blue waves-effect waves-light"><i class="mdi mdi-pencil"></i><b> Ubah </b></a> ' .
                        '<a onclick="delete_karyawan(' . $karyawan->id . ')" class="btn btn-outline-danger waves-effect waves-light"><i class="mdi mdi-close mr-1"></i><b> Hapus </b></a>';
                }
            })
            ->make(true);
    }

    public function upload(Request $request)
    {
        //VALIDASI
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file')->store('import'); //GET FILE
            $import = new DataKaryawans;
            $import->import($file);
            if ($import->failures()->isNotEmpty()) {
                return redirect()->back()->withFailures($import->failures());
            }

            return redirect()->back()->withStatus('File Excel Berhasil Di Upload');
        }
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }

    public function perubahan(Request $request)
    {
        //VALIDASI
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            DB::table('fail_upload_komponens')->delete();
            $file = $request->file('file')->store('import'); //GET FILE
            $import = new PerubahanKaryawan;
            $import->import($file);
            if ($import->failures()->isNotEmpty()) {
                return redirect()->back()->withFailures($import->failures());
            }

            return redirect()->back()->withStatus('File Excel Berhasil Di Upload');
        }
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }

    public function hapus_karyawan(Request $request)
    {
        //VALIDASI
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            DB::table('fail_upload_komponens')->delete();
            $file = $request->file('file')->store('import'); //GET FILE
            $import = new HapusKaryawan;
            $import->import($file);
            if ($import->failures()->isNotEmpty()) {
                return redirect()->back()->withFailures($import->failures());
            }

            return redirect()->back()->withStatus('File Excel Berhasil Di Upload');
        }
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }
}
