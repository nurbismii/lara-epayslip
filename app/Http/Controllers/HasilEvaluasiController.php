<?php

namespace App\Http\Controllers;

use App\Models\PenilaianPencapaianKinerja;
use App\Models\KomponenGaji;
use Illuminate\Http\Request;
use Auth;


class HasilEvaluasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PenilaianPencapaianKinerja::all();
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
        $data = PenilaianPencapaianKinerja::with('user')->findOrFail($id);
        $div = KomponenGaji::where('data_karyawan_id', $data->data_karyawan_id)
        ->where('periode','2023-01')
        ->first();

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

    public function detail_hasil_evaluasi ()
    {
        $data = PenilaianPencapaianKinerja::with('user')->where('data_karyawan_id', Auth::user()->data_karyawan->id)->first();
        $div = KomponenGaji::where('data_karyawan_id', $data->data_karyawan_id)
        ->where('periode','2023-01')
        ->first();

        return view('hasil_evaluasi.detail', compact('data', 'div'));
    }
}
