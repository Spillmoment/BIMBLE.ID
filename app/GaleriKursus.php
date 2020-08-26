<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GaleriKursus extends Model
{
    protected $table = 'galerikursus';

    protected $fillable = ['kursus_id', 'gambar'];

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id');
    }
}
