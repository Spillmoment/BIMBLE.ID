<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\KursusUnit;
use Illuminate\Http\Request;
use App\SiswaKursus;
use App\Unit;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use PDF;

class SiswaUnitController extends Controller
{
    public function index()
    {
        $unit = SiswaKursus::with(['siswa', 'kursus_unit'])
                ->get()->groupBy('kursus_unit.unit_id')->toArray();

        foreach ($unit as $key => $element) {
            $data_id_unit[] = [$key];
        }

        $unit_filter = Unit::find($data_id_unit);
        // dd($unit_filter);

        return view('admin.siswa_unit.index', [
            'unit' => $unit_filter
        ]);
    }

    public function detail_siswa($unit_id)
    {
        $siswa = SiswaKursus::with(['siswa', 'kursus_unit', 'kursus_unit.unit'])
            ->whereHas('kursus_unit.unit', function($q) use ($unit_id) {
                $q->where('unit_id', $unit_id);
            })
            ->where(function($q) {
                $q->where('status_sertifikat', 'lulus')
                    ->orWhere('status_sertifikat', 'sertifikat');
            })
            ->groupBy('siswa_id','kursus_unit_id')
            ->paginate(9);

        return view('admin.siswa_unit.detail', [
            'siswa' => $siswa
        ]);
    }

    public function confirm($id)
    {
        $data = SiswaKursus::with(['siswa','kursus_unit'])->find($id);
        $pdf = PDF::loadView('admin.siswa_unit.pdf', compact('data'))->setPaper('F4', 'landscape');
        $filename = $id.'-'.date('dmyHis').'.pdf';
        Storage::put('public/sertifikat/'.$filename, $pdf->output());

        SiswaKursus::where('id', $id)
            ->update([
                'status_sertifikat' => 'sertifikat',
                'sertifikat' => $filename
            ]);

        return back()->with(['status' => 'siswa berhasil dikonfirmasi']);
    }
    
    public function confirm_down($id)
    {
        $data = SiswaKursus::with(['siswa','kursus_unit'])->find($id);

        Storage::delete('public/sertifikat/'.$data->file);

        SiswaKursus::where('id', $id)
            ->update([
                'status_sertifikat' => 'lulus',
                'sertifikat' => null
            ]);

        return back()->with(['status' => 'Sertifikat siswa berhasil dihapus']);
    }

    public function download_sertifikat($filename)
    {
        $filepath = storage_path() . '/' . 'app' . '/public/sertifikat/' . $filename;
        return Response::download($filepath);
    }
}
