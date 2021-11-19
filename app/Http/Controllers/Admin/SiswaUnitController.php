<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\KursusUnit;
use App\SiswaKursus;
use App\Unit;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
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
        $unit = KursusUnit::with('unit', 'kursus')->where('unit_id', $unit_id)->first();

        if (request()->ajax()) {
            $query = SiswaKursus::with(['siswa', 'kursus_unit.kursus', 'kursus_unit.unit'])
                ->whereHas('kursus_unit.unit', function ($q) use ($unit_id) {
                    $q->where('unit_id', $unit_id);
                })
                ->where(function ($q) {
                    $q->where('status_sertifikat', 'lulus')
                        ->orWhere('status_sertifikat', 'sertifikat');
                })
                ->groupBy('siswa_id', 'kursus_unit_id');

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return
                        '<div class="btn-group">
                            <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="icon icon-sm">
                                    <span class="fas fa-ellipsis-h icon-dark"></span>
                                </span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                <a class="dropdown-item" href="' . route('kursus.show', $item->id) . '"><span
                                        class="fas fa-eye mr-2"></span>Detail</a>
                                
                                <form action="' . route('kursus.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button id="deleteButton" type="submit" class="dropdown-item text-danger" data-name="' . $item->nama_kursus .  '">
                                        <span class="fas fa-trash-alt mr-2"></span>Hapus</a>
                                    </button>
                                </form>
                            </div>
                        </div>';
                })
                ->addColumn('siswa', function ($item) {
                    return $item->siswa->nama_siswa ?? '';
                })
                ->addColumn('kursus', function ($item) {
                    return $item->kursus_unit->kursus->nama_kursus ?? '';
                })
                ->editColumn('foto', function ($item) {
                    return '<img src="' . url('storage/siswa/' . $item->siswa->foto) . '" style="max-height: 40px;"/>';
                })
                ->editColumn('status', function ($item) {
                    switch ($item->status_sertifikat) {
                        case 'daftar':
                            return ' <button class="btn btn-primary btn-sm">Daftar</button>';
                            break;
                        case 'terima':
                            return  '<button class="btn btn-info btn-sm">Siswa</button>';
                            break;
                        case 'lulus':
                            return '<button class="btn btn-success btn-sm">Lulus</button>';
                            break;
                        default:
                            return ' <button class="btn btn-gray btn-sm">Tuntas</button>';
                            break;
                    }
                })
                ->editColumn('status_sertifikat', function ($item) {
                    if ($item->status_sertifikat == 'sertifikat') {
                        return '<a class="btn btn-warning btn-sm"
                        href="' . route('siswa.unit.confirm_down', $item->id) . '"> <i
                            class="fas fa-check"></i> Hapus Sertifikat </a>';
                    } else {
                        return '<a class="btn btn-primary btn-sm"
                        href="' . route('siswa.unit.confirm', $item->id) . '"> <i
                        class="fas fa-check"></i> Setujui </a>';
                    }
                })
                ->editColumn('file', function ($item) {
                    return view('admin.siswa_unit.modal', ['item' => $item]);
                })
                ->rawColumns(['action', 'siswa', 'kursus', 'foto', 'status', 'status_sertifikat', 'file'])
                ->make();
        }

        return view('admin.siswa_unit.detail', [
            'unit'  => $unit
        ]);
    }

    public function confirm($id)
    {
        $data = SiswaKursus::with(['siswa', 'kursus_unit'])->find($id);
        $pdf = PDF::loadView('admin.siswa_unit.pdf', compact('data'))
            ->setPaper('F4', 'landscape');
        $filename = $data->siswa->nama_siswa . '-' . date('dmyHis') . '.pdf';
        Storage::put('public/sertifikat/' . $filename, $pdf->output());

        SiswaKursus::where('id', $id)
            ->update([
                'status_sertifikat' => 'sertifikat',
                'sertifikat' => $filename
            ]);

        return back()->with(['status' => 'siswa berhasil dikonfirmasi']);
    }

    public function confirm_down($id)
    {
        $data = SiswaKursus::with(['siswa', 'kursus_unit'])->find($id);

        Storage::delete('public/sertifikat/' . $data->file);

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
