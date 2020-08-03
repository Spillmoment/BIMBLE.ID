<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\TutorResetPasswordNotification;

class Tutor extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'tutor';
    protected $guard = 'tutor';

    protected $fillable = ['nama_tutor', 'alamat', 'email', 'foto', 'username', 'password', 'status', 'keahlian'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new TutorResetPasswordNotification($token));
    }

    // ------Relations Table------
    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'id', 'id_tutor');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id', 'id_tutor');
    }

    public function nilai()
    {
        return $this->belongsTo(Nilai::class, 'id', 'id_tutor');
    }

    protected $dates = ['deleted_at'];
}
