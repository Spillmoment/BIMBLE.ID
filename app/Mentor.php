<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mentor extends Model
{
    protected $table = 'mentor';
    protected $primaryKey = 'id';
    protected $fillable = [
        'unit_id', 'nama_mentor', 'kompetensi', 'foto'
    ];
    use SoftDeletes;
    
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
