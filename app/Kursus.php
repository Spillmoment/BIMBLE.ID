<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kursus extends Model
{
    protected $table = 'kursus';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_kursus', 'slug', 'gambar_kursus', 'keterangan'
    ];

    use SoftDeletes;
}
