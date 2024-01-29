<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKinerja extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','jenis_kinerja'
    ];

    public function rincian_kinerja() {
       return $this->hasMany(RincianKinerja::class);
    }
}
