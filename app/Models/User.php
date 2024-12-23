<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
        'status',
        'token',
        'data_karyawan_id'
    ];

    public function karyawan()
    {
        return $this->hasOne(DataKaryawan::class, 'id', 'data_karyawan_id');
    }

    public function komponenGaji()
    {
        return $this->hasOne(KomponenGaji::class, 'data_karyawan_id', 'data_karyawan_id')->orderBy('periode', 'DESC');
    }

    public function data_karyawan()
    {
        return $this->belongsTo(DataKaryawan::class);
    }

    public function lupa_password()
    {
        return $this->hasMany(LupaPassword::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
