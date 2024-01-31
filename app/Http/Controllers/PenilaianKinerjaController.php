<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenilaianPencapaianKinerja;
use App\Models\KomponenGaji;
use App\Imports\PenilaianKinerja;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PenilaianKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PenilaianPencapaianKinerja::all();
        return view('penilaian_kinerja.index', compact('data'));
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
            $import = new PenilaianKinerja;
            $import->import($file);

            if ($import->failures()->isNotEmpty()) {
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
        $data = PenilaianPencapaianKinerja::with('user')->findOrFail($id);
        $div = KomponenGaji::where('data_karyawan_id', $data->data_karyawan_id)
            ->where('periode', '2024-01')
            ->first();

        if ($data->pencapaian_kerja)
            $pencapaian_kerja = 0;

        $pencapaian_kerja = $data->total_nilai_pencapaian;

        $hasil_evaluasi_a_plus = ($pencapaian_kerja >= 18 && $pencapaian_kerja <= 20) ? $pencapaian_kerja : 0;
        $hasil_evaluasi_a = ($pencapaian_kerja >= 15 && $pencapaian_kerja <= 17) ? $pencapaian_kerja : 0;
        $hasil_evaluasi_a_min = ($pencapaian_kerja >= 13 && $pencapaian_kerja <= 14) ? $pencapaian_kerja : 0;
        $hasil_evaluasi_b_plus = ($pencapaian_kerja >= 11 && $pencapaian_kerja <= 12) ? $pencapaian_kerja : 0;
        $hasil_evaluasi_b = ($pencapaian_kerja >= 9 && $pencapaian_kerja <= 10) ? $pencapaian_kerja : 0;
        $hasil_evaluasi_b_min = ($pencapaian_kerja >= 7 && $pencapaian_kerja <= 8) ? $pencapaian_kerja : 0;
        $hasil_evaluasi_c_plus = ($pencapaian_kerja >= 5 && $pencapaian_kerja <= 6) ? $pencapaian_kerja : 0;
        $hasil_evaluasi_c = ($pencapaian_kerja >= 4 && $pencapaian_kerja <= 4) ? $pencapaian_kerja : 0;
        $hasil_evaluasi_c_min = ($pencapaian_kerja >= 2 && $pencapaian_kerja <= 3) ?: 0;

        return view('penilaian_kinerja.detail', compact('data', 'div', 'hasil_evaluasi_a_plus', 'hasil_evaluasi_a', 'hasil_evaluasi_a_min', 'hasil_evaluasi_b_plus', 'hasil_evaluasi_b', 'hasil_evaluasi_b_min', 'hasil_evaluasi_c_plus', 'hasil_evaluasi_c', 'hasil_evaluasi_c_min'));
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

    public function detail_penilaian_kinerja()
    {
        $data = PenilaianPencapaianKinerja::with('user')->where('data_karyawan_id', Auth::user()->data_karyawan->id)->first();
        if (!$data) {
            Alert::error('Opps', 'Data penilaian kamu belum tersedia');
            return back();
        }
        $div = KomponenGaji::where('data_karyawan_id', $data->data_karyawan_id)
            ->where('periode', '2024-01')
            ->first();

        return view('penilaian_kinerja.detail', compact('data', 'div'));
    }
}
