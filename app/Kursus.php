<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kursus extends Model
{
    protected $table = 'kursus';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kategori_id', 'nama_kursus', 'slug', 'gambar_kursus', 'keterangan', 'tentang', 'status', 'materi'
    ];

    use SoftDeletes;

    public function kursus_unit()
    {
        return $this->hasMany(KursusUnit::class, 'kursus_id', 'id');
    }

    public function galleries()
    {
        return $this->hasMany(GaleriKursus::class, 'kursus_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
