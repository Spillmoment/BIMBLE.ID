<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = ['id_kursus', 'id_tutor', 'nama_siswa', 'jenis_kelamin', 'alamat', 'foto', 'nilai', 'keterangan', 'username', 'password'];

    public function tutor()
    {
        return $this->hasMany(Tutor::class, 'id', 'id_tutor');
    }
}
