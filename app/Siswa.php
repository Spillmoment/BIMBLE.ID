<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = ['nama_siswa', 'jenis_kelamin', 'agama', 'alamat', 'status', 'email', 'username', 'password'];

}
