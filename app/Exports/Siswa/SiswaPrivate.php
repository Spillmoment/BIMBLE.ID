<?php

namespace App\Exports\Siswa;

use App\SiswaKursus;
use App\KursusUnit;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SiswaPrivate implements FromView, ShouldAutoSize
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

    $query = SiswaKursus::with([
      'siswa', 'kursus_unit.kursus', 'kursus_unit.unit',
      'kursus_unit.type'
    ])
      ->whereHas('kursus_unit.unit', function ($query) use ($unit) {
        $query
          ->where('unit_id', $unit);
      })
      ->whereHas('kursus_unit.type', function ($query) use ($type) {
        $query
          ->where('type_id', $type);
      })
      ->where(function ($query) {
        $query
          ->where('status_sertifikat', 'lulus')
          ->orWhere('status_sertifikat', 'sertifikat');
      })
      ->groupBy('siswa_id', 'kursus_unit_id')
      ->latest()
      ->get();

    $unit = KursusUnit::with(['unit', 'kursus.kategori'])
      ->where('unit_id', $this->id)->first();

    return view('admin.siswa_unit.export_private', [
      'siswa' => $query,
      'unit' => $unit
    ]);
  }
}
