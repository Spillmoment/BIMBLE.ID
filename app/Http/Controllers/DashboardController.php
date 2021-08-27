<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kursus;
use App\Unit;
use App\Komentar;
use App\KursusUnit;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{

    public function index()
    {
        $kursus_unit = KursusUnit::with(['kursus', 'unit'])
            ->groupBy('unit_id')
            ->get();

        $kursus_count = KursusUnit::all()
            ->where('unit_id', 1)
            ->groupBy('kursus_id')
            ->count();

        $unit_month = Unit::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');

        return view(
            'admin.dashboard.index',
            [
                'kursus' => Kursus::all()->count(),
                'unit' => Unit::where('status', '1')->count(),
                'pendaftar' => Unit::where('status', '0')->count(),
                'komentar' => Komentar::all()->count(),
                'kursus_unit' => $kursus_unit,
                'unit_chart' => $unit_month,
            ]
        );
    }
}
