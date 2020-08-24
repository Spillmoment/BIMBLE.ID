<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kursus extends Model
{
    protected $table = 'kursus';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_type', 'nama_kursus', 'slug', 'gambar_kursus', 'keterangan', 'tentang', 'status'
    ];

    use SoftDeletes;

    public function type()
    {
        return $this->hasMany(Type::class, 'id', 'id_type');
    }

    public function kursus_unit()
    {
        return $this->hasMany(KursusUnit::class, 'kursus_id', 'id');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kursus_id', 'id');
    }
}
