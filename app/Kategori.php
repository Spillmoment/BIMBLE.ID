<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    protected $table = 'kategori';

    use SoftDeletes;

    protected $fillable = ['nama_kategori', 'keterangan', 'status'];

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'id', 'id_kategori');
    }
}
