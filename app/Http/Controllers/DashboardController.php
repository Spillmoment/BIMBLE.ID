<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kursus;
use App\Unit;

class DashboardController extends Controller
{

    public function index()
    {
        $kursus = Kursus::all()->count();
        $unit = Unit::all()->count();

        return view(
            'admin.dashboard.index',
            [
                'kursus' => $kursus,
                'unit' => $unit,
            ]
        );
    }
}
