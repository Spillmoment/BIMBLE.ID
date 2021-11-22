<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keuangan extends Model
{
    protected $table = 'keuangan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'unit_id', 'rule_gaji_id', 'nominal', 'status'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    
    public function rule_gaji()
    {
        return $this->belongsTo(RuleGaji::class, 'rule_gaji_id');
    }
    
}
