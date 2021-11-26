<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\KursusUnit;
use App\Siswa;
use App\SiswaKursus;
use Illuminate\Support\Facades\DB;

class StatistikController extends Controller
{
    public function kursus()
    {
        $kursus_diagram_data = KursusUnit::select(DB::raw("(COUNT(*)) as count"), 'kursus.nama_kursus')
            ->join('kursus', 'kursus_unit.kursus_id', '=', 'kursus.id')
            ->join('unit', 'kursus_unit.unit_id', '=', 'unit.id')
            ->where('type_id', 2)
            ->groupBy('kursus_id')
            ->get();
        $kursus_diagram = $kursus_diagram_data->toArray();

        $trend_kursus_diagram = SiswaKursus::select(DB::raw("(COUNT(*)) as count"), 'kursus.nama_kursus')
            ->join('kursus_unit', 'siswa_kursus.kursus_unit_id', '=', 'kursus_unit.id')
            ->join('kursus', 'kursus_unit.kursus_id', '=', 'kursus.id')
            ->groupBy('kursus_unit.kursus_id')
            ->orderBy('count', 'DESC')
            ->limit(3)
            ->get();
        $trend_kursus = $trend_kursus_diagram->toArray();

        return view(
            'admin.statistik.kursus',
            [
                'kursus_chart' => $kursus_diagram,
                'trend_kursus_chart' => $trend_kursus
            ]
        );
    }

    public function siswa()
    {
        $siswa_diagram_data = SiswaKursus::select(DB::raw("(COUNT(*)) as count"), 'unit.nama_unit')
            ->join('kursus_unit', 'siswa_kursus.kursus_unit_id', '=', 'kursus_unit.id')
            ->join('unit', 'kursus_unit.unit_id', '=', 'unit.id')
            ->groupBy('kursus_unit.unit_id')
            ->get();
        $siswa_diagram = $siswa_diagram_data->toArray();
        
        $siswa_diagram_kabupaten = Siswa::select(DB::raw("(COUNT(*)) as count"), 'alamat_district')
            ->groupBy('alamat_district')
            ->get();
        // dd($siswa_diagram_kabupaten);

        // $count_active_diactive = Unit::select(DB::raw("(COUNT(*)) as count"), 'status')
        //     ->whereYear('created_at', date('Y'))
        //     ->groupBy('status')
        //     ->get();

        return view(
            'admin.statistik.siswa',
            [
                'siswa_chart' => $siswa_diagram,
                'siswa_per_kab' => $siswa_diagram_kabupaten,
                // 'count_active_diactive' => $count_active_diactive->toArray()
            ]
        );
    }
}
