<?php

namespace App\Exports;

use App\KursusUnit;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UnitKursusExports implements FromView, ShouldAutoSize
{
    protected $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $query = KursusUnit::with(['unit', 'kursus'])
            ->where('unit_id', $this->id)
            ->where('type_id', '2')
            ->latest()
            ->get();

        $unit = KursusUnit::with(['unit', 'kursus.kategori'])
            ->where('unit_id', $this->id)->first();

        return view('admin.unit_kursus.export', [
            'kursus_unit' => $query,
            'unit' => $unit
        ]);
    }
}
