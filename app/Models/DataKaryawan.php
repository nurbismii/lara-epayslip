<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKaryawan extends Model
{
    protected $fillable = [
        'nik','no_ktp','nama','tgl_lahir','nm_perusahaan','npwp','bpjs_ket','bpjs_tk','vaksin_1','tgl_join'
    ];
    use HasFactory;

    public function komponen_gaji() {
        return $this->hasMany(KomponenGaji::class);
    }

    public function user() {
        return $this->hasOne(User::class);
    }

    public function hasil_kinerja()
    {
        return $this->hasMany(PenilaianPencapaianKinerja::class);
    }

    public function evaluasi_ketenagakerjaan()
    {
        return $this->hasMany(EvaluasiKetenagakerjaan::class);
    }
}
