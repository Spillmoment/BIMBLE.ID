<?php

namespace App\Exports\Unit;

use App\Unit;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UnitPendaftarExports implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('admin.pendaftar.export', [
            'unit' => Unit::where('status', '2')->latest()->get()
        ]);
    }
}
