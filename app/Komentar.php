<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Komentar extends Model
{
    protected $table = 'detail_komentar';

    use SoftDeletes;

    public function kursus()
    {
        return $this->hasMany(Kursus::class, 'id', 'id_kursus');
    }
    
    public function pendaftar()
    {
        return $this->hasMany(Pendaftar::class, 'id', 'id_pendaftar');
    }
}
