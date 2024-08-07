<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KomponenGaji;
use PDF;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SlipGajiController extends Controller
{
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
        return view('slip_gaji.index');
    }

    public function search(Request $request)
    {
        $periode = $request['month'];
        $cek = KomponenGaji::where('data_karyawan_id', Auth::user()->data_karyawan->id)
            ->where('periode', $periode)
            ->first();
        if ($cek === null) {
            Alert::error('Tidak Tersedia', 'Slip Gaji Anda Tidak Tersedia di Periode Tersebut');
            return redirect()->route('slip_gaji');
        } else {
            return view('slip_gaji.slip', compact('cek'));
        }
    }

    public function cetak_pdf($periode)
    {
        $cek = KomponenGaji::where('data_karyawan_id', Auth::user()->data_karyawan->id)
            ->where('periode', $periode)
            ->first();

        $pdf = PDF::loadview('slip_gaji.slip-pdf', ['cek' => $cek]);
        return $pdf->download('Slip-Gaji-' . date("F-Y", strtotime($periode)) . '.pdf');
    }
}
