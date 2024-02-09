<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKaryawan;
use App\Models\KomponenGaji;
use Excel;
use App\Imports\DataKaryawans;
use App\Imports\PerubahanKaryawan;
use App\Imports\HapusKaryawan;
use App\Jobs\ImportJob;
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
    public function index()
    {
        if(Auth::user()->level == "Administrator") {
            $data = DataKaryawan::all();
            return view('karyawan.index', compact('data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
          $cek = DataKaryawan::where('nik',$request['nik'])
                 ->orWhere('no_ktp',$request['no_ktp'])
                 ->first();
          if($cek === Null) {
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->level == "Administrator") {
            $data = DataKaryawan::findOrFail($id);
            return $data;
        }
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
        if(Auth::user()->level == "Administrator") {
            $upd = DataKaryawan::findOrFail($id);
            $upd->nik = $request['nik'];
            $upd->no_ktp = $request['no_ktp'];
            $upd->nama = $request['nama'];
            $upd->nm_perusahaan = $request['nm_perusahaan'];
            $upd->tgl_lahir = $request['tgl_lahir'];
            $upd->npwp = $request['npwp'];
            $upd->bpjs_ket = $request['bpjs_ket'];
            $upd->bpjs_tk = $request['bpjs_tk'];
            $upd->vaksin_1 = $request['vaksin_1'];

            $upd->tgl_join = $request['tgl_join'];
            if(($request['nik'] == $request['nik_lm']) && ($request['no_ktp'] == ($request['no_ktp_lm']))){
                $upd->update();
                return $upd;
            } else if(($request['nik'] != $request['nik_lm']) && ($request['no_ktp'] == ($request['no_ktp_lm']))) {
                $cek = DataKaryawan::where('nik',$request['nik'])
                        ->first();
                if($cek === Null) {
                    return $upd->update();
                } else {
                    return $upd->update();
                }
            } else if(($request['nik'] == $request['nik_lm']) && ($request['no_ktp'] != ($request['no_ktp_lm']))) {
                $cek = DataKaryawan::where('no_ktp',$request['no_ktp'])
                        ->first();
                if($cek === Null) {
                    return $upd->update();
                } else {
                    return $upd->update();
                }
            } else if(($request['nik'] != $request['nik_lm']) && ($request['no_ktp'] != ($request['no_ktp_lm']))) {
               $cek = DataKaryawan::where('nik',$request['nik'])
                 ->orWhere('no_ktp',$request['no_ktp'])
                 ->first();
                if($cek === Null) {
                    return $upd->update();
                } else {
                    return $upd->update();
                }
            }

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
        if(Auth::user()->level == "Administrator") {
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
     ->addColumn('action', function($karyawan) {
       if(Auth::user()->level == "Administrator") {
        return
       '<a onclick="edit_karyawan('. $karyawan->id .')"  class="btn btn-outline-blue waves-effect waves-light"><i class="mdi mdi-pencil"></i><b> Ubah </b></a> ' .
       '<a onclick="delete_karyawan('. $karyawan->id .')" class="btn btn-outline-danger waves-effect waves-light"><i class="mdi mdi-close mr-1"></i><b> Hapus </b></a>';
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
            if($import->failures()->isNotEmpty()){
                return redirect()->back()->withFailures($import->failures());
            }

            return redirect()->back()->withStatus('File Excel Berhasil Di Upload');
        }
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }

    public function delete_all(Request $request)
    {
       DB::table('data_karyawans')->delete();
       Alert::success('Sukses', 'Data Berhasil Dihapus');
       return redirect()->route('karyawan.index');
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
            if($import->failures()->isNotEmpty()){
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
            if($import->failures()->isNotEmpty()){
                return redirect()->back()->withFailures($import->failures());
            }

            return redirect()->back()->withStatus('File Excel Berhasil Di Upload');
        }
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }


}
