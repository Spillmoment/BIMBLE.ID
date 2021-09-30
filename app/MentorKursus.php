<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MentorKursus extends Model
{
    protected $table = 'mentor_kursus';
    protected $primaryKey = 'id';
    protected $fillable = [
        'mentor_id', 'kursus_unit_id'
    ];
    
    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'mentor_id');
    }
    
    public function kursus_unit()
    {
        return $this->belongsTo(KursusUnit::class, 'kursus_unit_id');
    }
}
