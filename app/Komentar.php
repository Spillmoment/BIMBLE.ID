<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Komentar extends Model
{
    protected $table = 'komentar';

    protected $fillable = ['kursus_unit_id', 'nama', 'email', 'komentar'];

    use SoftDeletes;

    public function kursus_unit()
    {
        return $this->hasMany(KursusUnit::class, 'id', 'kursus_unit_id');
    }
}
