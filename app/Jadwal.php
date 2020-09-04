<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $fillable = ['kursus_unit_id', 'hari', 'waktu_mulai', 'waktu_selesai'];

    public function kursus_unit()
    {
        return $this->belongsTo(KursusUnit::class, 'kursus_unit_id');
    }
}
