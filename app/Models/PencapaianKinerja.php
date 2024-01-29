<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencapaianKinerja extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','rincian_kinerja_id','pencapaian_kinerja'
    ];

    public function rincian_kinerja()
    {
        return $this->belongsTo(RincianKinerja::class);
    }

    public function hasil_penilian()
    {
        return $this->hasMany(HasilPenilaian::class);
    }

}
