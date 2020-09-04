<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'type';
    protected $fillable = ['nama_type', 'slug'];

    public function kursus_unit()
    {
        return $this->hasMany(KursusUnit::class, 'type_id', 'id');
    }
}
