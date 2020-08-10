<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Unit;

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
        $unit = Unit::where('slug', $slug)->firstOrFail();
        return view('web.web_unit_kursus', [
            'unit' => $unit
        ]);
    }
}
