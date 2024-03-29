<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\SiswaResetPasswordNotification;

class Siswa extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'siswa';
    protected $guard = 'siswa';

    protected $fillable = ['nama_siswa', 'jenis_kelamin', 'alamat_province','alamat_district','alamat_sub_district','alamat_village','foto', 'status', 'email','no_telp', 'password'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new SiswaResetPasswordNotification($token));
    }

    public function siswa_kursus()
    {
        return $this->hasMany(SiswaKursus::class, 'siswa_id', 'id');
    }

    protected $dates = ['deleted_at'];
}
