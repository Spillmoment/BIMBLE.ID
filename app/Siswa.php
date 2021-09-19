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

    protected $fillable = ['nama_siswa', 'jenis_kelamin', 'agama', 'alamat', 'foto', 'status', 'email', 'username', 'password'];

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

    protected $dates = ['deleted_at'];

}
