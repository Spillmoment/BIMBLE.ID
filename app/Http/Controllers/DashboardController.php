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
            ->groupBy('unit_id')->get();

        $unit_month = Unit::select(DB::raw("(COUNT(*)) as count"), DB::raw("MONTHNAME(created_at) as monthname"))
            ->whereYear('created_at', date('Y'))
            ->groupBy('monthname')
            ->get();

        dd($unit_month);

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
