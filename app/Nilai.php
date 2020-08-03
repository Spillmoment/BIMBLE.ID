<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';

    protected $fillable = ['id_tutor', 'id_pendaftar', 'id_kursus', 'nilai', 'keterangan'];

    public function tutor()
    {
        return $this->hasMany(Tutor::class, 'id', 'id_tutor');
    }

    public function pendaftar()
    {
        return $this->hasMany(Pendaftar::class, 'id', 'id_pendaftar');
    }

    public function kursus()
    {
        return $this->hasMany(Kursus::class, 'id', 'id_kursus');
    }
}
