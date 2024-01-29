<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPenilaian extends Model
{
    use HasFactory;
    protected $fillable = [
        'data_karyawan_id','rincian_kinerja_id','pencapaian_kinerja_id','nilai'
    ];

    public function pencapaian_kinerja()
    {
        return $this->belongsTo(PencapaianKinerja::class);
    }

    public function rincian_kinerja()
    {
        return $this->belongsTo(RincianKinerja::class);
    }
}
