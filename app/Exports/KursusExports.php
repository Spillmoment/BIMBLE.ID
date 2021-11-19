<?php

namespace App\Exports;

use App\Kursus;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KursusExports implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('admin.kursus.export', [
            'kursus' => Kursus::latest()->get()
        ]);
    }
}
