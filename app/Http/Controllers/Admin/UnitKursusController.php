<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\KursusUnit;
use Illuminate\Http\Request;

class UnitKursusController extends Controller
{
    public function index() {

        $kursus_unit = KursusUnit::with(['unit','kursus'])
                        ->groupBy('unit_id')
                        ->latest()
                        ->get();

        return view('admin.unit_kursus.index',[
            'query' => $kursus_unit
        ]);
    }

    public function detail($id) {
    
        $kursus_unit = KursusUnit::with(['unit','kursus'])
            ->where('id',$id)
            ->groupBy('kursus_id')
            ->get();
        
        

        dd($kursus_unit);
        
        return view('admin.unit_kursus.detail',[
                'query' => $kursus_unit
        ]);

    }
}
