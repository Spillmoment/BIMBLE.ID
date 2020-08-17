<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Unit;
use App\Kursus;
use App\KursusUnit;

class UnitController extends Controller
{
    public function index()
    {
        return view('web.web_unit');
    }

    public function post()
    {
    }

    public function show($slug)
    {
        $unit = Unit::with(['kursus_unit', 'mentor', 'fasilitas'])
            ->where('slug', $slug)
            ->firstOrFail();

        $nama_kursus = KursusUnit::with(['kursus', 'unit'])
            ->where('unit_id', $unit->id)
            ->first();

        $kursus_lainya = KursusUnit::with(['kursus', 'unit'])
            ->where('unit_id', $unit->id)
            ->get();

        // dd($kursus_lainya);

        return view('web.web_unit_kursus', [
            'unit' => $unit,
            'kursus_unit' => $nama_kursus,
            'kursus_lainya' => $kursus_lainya
        ]);
    }
}
