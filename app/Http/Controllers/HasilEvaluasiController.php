<?php

namespace App\Http\Controllers;

use App\Models\PenilaianPencapaianKinerja;
use App\Models\KomponenGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HasilEvaluasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PenilaianPencapaianKinerja::where('data_karyawan_id', '179889')->get();
        return view('hasil_evaluasi.index', compact('data'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = PenilaianPencapaianKinerja::with([
            'user',
            'data_karyawan',
            'data_karyawan.evaluasi_ketenagakerjaan',
        ])->findOrFail($id);

        // Pastikan data karyawan ada
        if (!$data->data_karyawan) {
            Alert::error('Oops', 'Data karyawan tidak ditemukan');
            return back();
        }

        $div = KomponenGaji::with('data_karyawan')
            ->where('data_karyawan_id', $data->data_karyawan_id)
            ->where('periode', '2025-01')
            ->first();

        if (!$div) {
            Alert::error('Oops', 'Data gaji belum tersedia dari hasil evaluasi');
            return back();
        }

        return view('hasil_evaluasi.detail', compact('data', 'div'));
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

    public function detail_hasil_evaluasi()
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
        $div = KomponenGaji::with('data_karyawan')->where('data_karyawan_id', $data->data_karyawan_id)
            ->where('periode', '2026-01')
            ->first();

        return view('hasil_evaluasi.detail', compact('data', 'div'));
    }
}
