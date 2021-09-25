<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SiswaKursus;

class SiswaUnitController extends Controller
{
    public function index()
    {
        $siswa_unit = SiswaKursus::with(['siswa', 'kursus_unit'])
            ->latest()->get();

        return view('admin.siswa_unit.index', [
            'unit' => $siswa_unit
        ]);
    }

    public function detail_siswa($id)
    {
        $siswa = SiswaKursus::with(['siswa', 'kursus_unit'])
            ->findOrFail($id);
        dd($siswa);
    }
}
