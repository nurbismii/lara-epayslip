<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResendEmail extends Model
{
    protected $fillable = [
        'user_id', 'waktu'
    ];
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }
}
