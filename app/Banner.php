<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banner';

    protected $fillable = [
        'kata1', 'kata2', 'gambar_banner'
    ];
}
