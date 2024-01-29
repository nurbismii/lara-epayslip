<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianPencapaianKinerja extends Model
{
    use HasFactory;
    protected $fillable = [
        'data_karyawan_id','rasa_tanggung_jawab','kedisiplinan','etika_kerja','pengetahuan_profesi','pengambilan_keputusan','pemahaman_dalam_bekerja','pengendalian_diri','kualitas_kerja','efesiensi_kerja','keselamatan_dalam_kerja','total_nilai_kinerja','sangat_baik','baik','cukup','kurang','total_nilai_pencapaian','pencapaian_kerja'
    ];

    public function data_karyawan()
    {
        return $this->belongsTo(DataKaryawan::class);
    }
}
