<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomponenGaji extends Model
{
    protected $fillable = [
        'data_karyawan_id','durasi_sp','jml_hari_kerja','jml_hour_machine','gaji_pokok','tunj_um',
        'tunj_pengawas','tunj_transport','tunj_mk','tunj_koefisien','ot','hm','rapel','insentif',
        'tunj_lap','jht','jp','pot_bpjskes','unpaid_leave','deduction','tot_diterima','bank_name',
        'bank_number','periode','departemen','divisi','posisi','status_gaji','thr','bonus','deduction_pph21'
    ];
    use HasFactory;


    public function data_karyawan() {
        return $this->belongsTo(DataKaryawan::class);
    }

}
