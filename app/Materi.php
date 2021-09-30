<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Materi extends Model
{
    protected $table = 'materi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kursus_id', 'unit_id', 'bab', 'judul', 'konten', 'file'
    ];

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
