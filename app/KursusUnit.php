<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KursusUnit extends Model
{
    protected $table = 'kursus_unit';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kursus_id', 'unit_id', 'biaya_kursus'
    ];
    use SoftDeletes;

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id');
    }
    
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
