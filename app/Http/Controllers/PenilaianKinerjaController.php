<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenilaianPencapaianKinerja;
use App\Models\KomponenGaji;
use App\Imports\PenilaianKinerja;
use App\Jobs\ProsesImportPenilaianKinerja;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

        try {
            if ($request->hasFile('file')) {
                DB::beginTransaction();

                DB::table('fail_upload_komponens')->delete();
                $file = Storage::putFile('public', $request->file('file'));

                ProsesImportPenilaianKinerja::dispatch($file);

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
        $data = PenilaianPencapaianKinerja::with('user')->findOrFail($id);

        $div = KomponenGaji::where('data_karyawan_id', $data->data_karyawan_id)
            ->where('periode', '2026-01')
            ->first();

        if (!$div) {
            Alert::error('Opps', 'Data gaji belum tersedia dari hasil evaluasi');
            return back();
        }

        $penilaian = config('PenilaianKinerja');

        $pencapaianKerja = [];

        if (!empty($data->total_nilai_pencapaian)) {

            $nilai = $data->total_nilai_pencapaian;

            $mapping = [
                'A+' => [18, 20],
                'A'  => [15, 17],
                'A-' => [13, 14],
                'B+' => [11, 12],
                'B'  => [9, 10],
                'B-' => [7, 8],
                'C+' => [5, 6],
                'C'  => [4, 4],
                'C-' => [2, 3],
            ];

            foreach ($mapping as $label => [$min, $max]) {
                $pencapaianKerja[] = [
                    'label' => $label,
                    'value' => ($nilai >= $min && $nilai <= $max) ? $nilai : 0
                ];
            }
        }

        return view('penilaian_kinerja.detail', compact('data', 'div', 'pencapaianKerja', 'penilaian'));
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
        if (Auth::user()->data_karyawan->id == '177873' || Auth::user()->data_karyawan->id == '181732' || Auth::user()->data_karyawan->id == '182177' || Auth::user()->data_karyawan->id == '182275') {
            Alert::error('Oppss', 'Data penilaian kamu tidak dapat ditemukan, silahkan laporkan ini ke kantor HRD');
            return back();
        }

        $data = PenilaianPencapaianKinerja::with('user')->where('data_karyawan_id', Auth::user()->data_karyawan->id)->first();

        if (!$data) {
            Alert::error('Opps', 'Data penilaian kamu belum tersedia');
            return back();
        }

        $div = KomponenGaji::where('data_karyawan_id', $data->data_karyawan_id)
            ->where('periode', '2026-01')
            ->first();

        $penilaian = config('penilaian_kinerja');

        $pencapaianKerja = [];

        if (!empty($data->total_nilai_pencapaian)) {

            $nilai = $data->total_nilai_pencapaian;

            $mapping = [
                'A+' => [18, 20],
                'A'  => [15, 17],
                'A-' => [13, 14],
                'B+' => [11, 12],
                'B'  => [9, 10],
                'B-' => [7, 8],
                'C+' => [5, 6],
                'C'  => [4, 4],
                'C-' => [2, 3],
            ];

            foreach ($mapping as $label => [$min, $max]) {
                $pencapaianKerja[] = [
                    'label' => $label,
                    'value' => ($nilai >= $min && $nilai <= $max) ? $nilai : 0
                ];
            }
        }

        return view('penilaian_kinerja.detail', compact('data', 'div', 'pencapaianKerja', 'penilaian'));

        Alert::error('Terjadi kesalahan', 'Opps, terjadi kesalahan penilaian kamu tidak dapat ditemukan');
        return back();
    }
}
