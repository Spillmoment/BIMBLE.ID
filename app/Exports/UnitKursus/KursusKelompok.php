<?php

namespace App\Exports\UnitKursus;

use App\KursusUnit;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KursusKelompok implements FromView, ShouldAutoSize
{
  protected $id;
  protected $type;

  function __construct($id, $type)
  {
    $this->id = $id;
    $this->type = $type;
  }

  public function view(): View
  {

    $unit = $this->id;
    $type = $this->type;

    $query = KursusUnit::with(['unit', 'kursus.kategori', 'type'])
      ->where('unit_id', $unit)
      ->where('type_id', $type)
      ->latest()
      ->get();

    $unit = KursusUnit::with(['unit', 'kursus.kategori'])
      ->where('unit_id', $this->id)->first();

    return view('admin.unit_kursus.export_kelompok', [
      'kursus_unit' => $query,
      'unit' => $unit
    ]);
  }
}
