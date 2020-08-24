<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'type';
    protected $fillable = ['nama_type', 'slug'];

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'id', 'id_type');
    }
}
