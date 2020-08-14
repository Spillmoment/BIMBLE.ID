<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'unit_id', 'item', 'tambahan'
    ];
    use SoftDeletes;
    
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
