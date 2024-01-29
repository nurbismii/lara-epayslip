<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LupaPassword extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','token','status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
