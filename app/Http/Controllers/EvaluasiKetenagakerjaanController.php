<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvaluasiKetenagakerjaan;
use App\Models\KomponenGaji;
use Excel;
use App\Imports\EvaluasiKetenagakerjaanImport;
use App\Jobs\ImportJob;
use DB;
use Auth;

class EvaluasiKetenagakerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = EvaluasiKetenagakerjaan::all();
        return view('evaluasi_ketenagakerjaan.index', compact('data'));
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
          //VALIDASI
          $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            DB::table('fail_upload_komponens')->delete();
            $file = $request->file('file')->store('import'); //GET FILE
            $import = new EvaluasiKetenagakerjaanImport;
            $import->import($file);

            if($import->failures()->isNotEmpty()){
                return redirect()->back()->withFailures($import->failures());
            }
            return redirect()->back()->withStatus('File Excel Berhasil Di Upload');
        }
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = EvaluasiKetenagakerjaan::findOrFail($id);
        $div = KomponenGaji::where('data_karyawan_id', $data->data_karyawan_id)
        ->where('periode','2023-01')
        ->first();
        return view('evaluasi_ketenagakerjaan.detail', compact('data', 'div'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function detail_evaluasi()
    {
        $data = EvaluasiKetenagakerjaan::where('data_karyawan_id', Auth::user()->data_karyawan->id)->first();
        $div = KomponenGaji::where('data_karyawan_id', $data->data_karyawan_id)
        ->where('periode','2023-01')
        ->first();
        return view('evaluasi_ketenagakerjaan.detail', compact('data', 'div'));
    }
}
