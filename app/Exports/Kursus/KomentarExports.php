<?php

namespace App\Exports\Kursus;

use App\Komentar;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KomentarExports implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('admin.komentar.export', [
            'komentar' => Komentar::latest()->get()
        ]);
    }
}
