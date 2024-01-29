<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailUploadKomponen extends Model
{
    use HasFactory;
    protected $fillable = [
        'baris','nik','no_ktp'
    ];
}
