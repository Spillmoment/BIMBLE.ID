<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\KursusUnit;
use Illuminate\Http\Request;
use App\SiswaKursus;

class SiswaUnitController extends Controller
{
    public function index()
    {
        $unit = SiswaKursus::with(['siswa', 'kursus_unit.unit'])
            ->latest()
            ->paginate(9);


        return view('admin.siswa_unit.index', [
            'unit' => $unit
        ]);
    }

    public function detail_siswa()
    {
        $siswa = SiswaKursus::with(['siswa', 'kursus_unit'])
            ->latest()
            ->paginate(9);

        return view('admin.siswa_unit.detail', [
            'siswa' => $siswa
        ]);
    }

    public function confirm($id)
    {
        SiswaKursus::where('id', $id)
            ->update([
                'status_sertifikat' => 'sertifikat'
            ]);

        return back()->with(['status' => 'siswa berhasil dikonfirmasi']);
    }
}
