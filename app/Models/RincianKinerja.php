<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianKinerja extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','jenis_kinerja_id','rincian_kinerja'
    ];

    public function jenis_kinerja(){
        return $this->belongsTo(JenisKinerja::class);
    }

    public function pencapaian_kinerja()
    {
        return $this->hasMany(PencapaianKinerja::class);
    }

    public function hasil_penilaian()
    {
        return $this->hasMany(HasilPenilaian::class);
    }
}
