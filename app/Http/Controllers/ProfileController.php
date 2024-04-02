<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KomponenGaji;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
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
        $data = KomponenGaji::where('data_karyawan_id', Auth::user()->data_karyawan->id)
            ->orderby('periode', 'desc')
            ->first();

        if (!$data) {
            Alert::info('Info', 'Epayslip tidak dapat ditemukan..');
            return back();
        }

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

        $bulan = Carbon::now()->diffInMonths($jatuh_tempo);
        $hari  = Carbon::now()->diffInDays($jatuh_tempo);

        $msg_bulan = $bulan > 0 ? $bulan . ' ' . 'bulan' : '';
        $msg_hari = $msg_bulan == '' ? $hari . ' ' . 'hari' : '';

        $jatuh_tempo = $msg_bulan . ' ' . $msg_hari;

        $masa_berlaku_covid = '2024-12-31';

        $bulan_covid = Carbon::now()->diffInMonths($masa_berlaku_covid);
        $hari_covid  = Carbon::now()->diffInDays($masa_berlaku_covid);

        $msg_bulan_covid = $bulan_covid > 0 ? $bulan_covid . ' ' . 'bulan' : '';
        $msg_hari_covid = $hari_covid == '' ? $hari_covid . ' ' . 'hari' : '';

        $jatuh_tempo_covid = $msg_bulan_covid . ' ' . $msg_hari_covid;

        return view('profile.index', compact('data', 'data_cuti', 'jatuh_tempo', 'jatuh_tempo_covid'));
    }
}
