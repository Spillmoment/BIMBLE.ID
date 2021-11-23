<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiswaKursus extends Model
{
    protected $table = 'siswa_kursus';
    protected $primaryKey = 'id';
    protected $fillable = [
        'siswa_id', 'kursus_unit_id', 'status_sertifikat', 'nilai', 'predikat', 'file', 'invalid_message'
    ];
    
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
    
    public function kursus_unit()
    {
        return $this->belongsTo(KursusUnit::class, 'kursus_unit_id');
    }
}
