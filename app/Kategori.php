<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = ['nama_kategori', 'slug'];

    public function kursus()
    {
        return $this->hasMany(Kursus::class, 'kategori_id', 'id');
    }
}
