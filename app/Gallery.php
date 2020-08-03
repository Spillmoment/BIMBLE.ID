<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    protected $table = 'galleries';

    use SoftDeletes;

    protected $fillable = [
        'kursus_id', 'image'
    ];

    protected $hidden = [];

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id', 'id');
    }
}
