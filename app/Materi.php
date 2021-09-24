<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Materi extends Model
{
    protected $table = 'materi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kursus_unit_id', 'bab', 'judul', 'file'
    ];

    public function kursus_unit()
    {
        return $this->belongsTo(KursusUnit::class, 'kursus_unit_id');
    }

}
