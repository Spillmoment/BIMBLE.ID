<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'type';
    protected $fillable = ['nama_type', 'slug'];

    public function kursus_unut()
    {
        return $this->hasMany(Type::class, 'type_id', 'id');
    }
}
