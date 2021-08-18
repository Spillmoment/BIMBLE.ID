<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = ['kursus_unit_id', 'nama_siswa', 'jenis_kelamin', 'alamat', 'nilai'];

    public function kursus()
    {
        return $this->belongsTo(KursusUnit::class, 'kursus_unit_id');
    }
}
