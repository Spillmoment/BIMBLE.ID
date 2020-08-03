<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    protected $table = 'order_detail';

    use SoftDeletes;

    protected $fillable = ['id_order', 'id_pendaftar', 'id_kursus', 'biaya_kursus', 'status'];


    public function order()
    {
        return $this->hasMany(Order::class, 'id', 'id_order');
    }

    public function pendaftar()
    {
        return $this->hasMany(Pendaftar::class, 'id', 'id_pendaftar');
    }

    public function kursus()
    {
        return $this->hasMany(Kursus::class, 'id', 'id_kursus');
    }

    protected $dates = ['deleted_at'];
}
