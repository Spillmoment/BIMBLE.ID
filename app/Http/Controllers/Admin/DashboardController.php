<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        $unit_month = Unit::select(DB::raw("(COUNT(*)) as count"), DB::raw("MONTHNAME(created_at) as monthname"))
            ->whereYear('created_at', date('Y'))
            ->groupBy('monthname')
            ->get();
        $unit_month_array = $unit_month->toArray();
        
        $count_active_diactive = Unit::select(DB::raw("(COUNT(*)) as count"), 'status')
            ->whereYear('created_at', date('Y'))
            ->groupBy('status')
            ->get();
        // dd($unit_month_array[1]['monthname']);
        // dd(json_encode($count_active_diactive->toArray()));
        return view(
            'admin.dashboard.index',
            [
                'kursus' => Kursus::all()->count(),
                'unit' => Unit::where('status', '1')->count(),
                'pendaftar' => Unit::where('status', '0')->count(),
                'komentar' => Komentar::all()->count(),
                'kursus_unit' => $kursus_unit,
                'unit_chart' => $unit_month_array,
                'count_active_diactive' => $count_active_diactive->toArray()
            ]
        );
    }
}
