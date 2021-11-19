<?php

namespace App\Exports;

use App\Unit;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UnitExports implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('admin.unit.export', [
            'unit' => Unit::where('status', '1')
                ->orWhere('status', '0')
                ->latest()->get()
        ]);
    }
}
