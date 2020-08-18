<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galeri extends Model
{
    protected $table = 'galeri';

    use SoftDeletes;

    protected $fillable = [
        'unit_id', 'gambar'
    ];

    protected $hidden = [];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
