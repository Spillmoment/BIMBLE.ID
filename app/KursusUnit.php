<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KursusUnit extends Model
{
    protected $table = 'kursus_unit';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kursus_id', 'unit_id', 'type_id', 'biaya_kursus', 'status'
    ];
    use SoftDeletes;

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function komentar()
    {
        return $this->belongsTo(Komentar::class, 'id', 'kursus_unit_id');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'kursus_unit_id', 'id');
    }

    public function mentor_kursus()
    {
        return $this->hasMany(MentorKursus::class, 'kursus_unit_id', 'id');
    }
    
    public function siswa_kursus()
    {
        return $this->hasMany(SiswaKursus::class, 'kursus_unit_id', 'id');
    }
    
    public function materi()
    {
        return $this->hasMany(Materi::class, 'kursus_unit_id', 'id');
    }

}
