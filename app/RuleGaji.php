<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RuleGaji extends Model
{
    protected $table = 'rule_gaji';
    protected $primaryKey = 'id';
    protected $fillable = [
        'lppk', 'unit'
    ];
    
    public function keuangan()
    {
        return $this->hasMany(Keuangan::class, 'rule_gaji_id', 'id');
    }
}
