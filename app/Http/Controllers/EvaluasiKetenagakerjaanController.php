<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvaluasiKetenagakerjaan;
use App\Models\KomponenGaji;
use App\Jobs\ProsesImportEvaluasiKetenagakerjaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

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

        try {
            if ($request->hasFile('file')) {
                DB::beginTransaction();

                DB::table('fail_upload_komponens')->delete();
                $file = Storage::putFile('public', $request->file('file'));

                ProsesImportEvaluasiKetenagakerjaan::dispatch($file);
                DB::commit();

                Alert::success('Sukses', 'File berhasil diupload, file sedang diproses dibelakang layar, silahkan tunggu proses selesai');
                return back();
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Please choose file before']);
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
        $data = EvaluasiKetenagakerjaan::with('user')->findOrFail($id);

        $div = KomponenGaji::where('data_karyawan_id', $data->data_karyawan_id)
            ->where('periode', '2026-01')
            ->first();

        if (!$div) {
            Alert::error('Opps', 'Data gaji belum tersedia dari hasil evaluasi');
            return back();
        }
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
        if (Auth::user()->data_karyawan->id == '177873' || Auth::user()->data_karyawan->id == '181732' || Auth::user()->data_karyawan->id == '182177' || Auth::user()->data_karyawan->id == '182275') {
            Alert::error('Oppss', 'Data penilaian kamu tidak dapat ditemukan, silahkan laporkan ini ke kantor HRD');
            return back();
        }

        $data = EvaluasiKetenagakerjaan::with('user')->where('data_karyawan_id', Auth::user()->data_karyawan->id)->first();
        if (!$data) {
            Alert::error('Opps', 'Data penilaian kamu belum tersedia');
            return back();
        }
        $div = KomponenGaji::where('data_karyawan_id', $data->data_karyawan_id)
            ->where('periode', '2026-01')
            ->first();
        return view('evaluasi_ketenagakerjaan.detail', compact('data', 'div'));
    }
}
