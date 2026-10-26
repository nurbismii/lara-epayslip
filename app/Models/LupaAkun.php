<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LupaAkun extends Model
{
    protected $fillable = ['user_id', 'email', 'token', 'account_hash', 'expires_at'];

    protected $hidden = ['token', 'account_hash'];

    protected $casts = ['expires_at' => 'datetime'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
