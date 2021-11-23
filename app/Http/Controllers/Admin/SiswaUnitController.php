<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Siswa\SiswaKelompok;
use App\Exports\Siswa\SiswaPrivate;
use App\Http\Controllers\Controller;
use App\KursusUnit;
use App\SiswaKursus;
use App\Unit;
use App\Type;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

        return view('admin.siswa_unit.index', [
            'unit' => $unit_filter
        ]);
    }

    public function detail_siswa(Request $request, $unit_id)
    {
        $unit = KursusUnit::with('unit', 'kursus')
            ->where('unit_id', $unit_id)->first();

        $type = Type::latest()->get();
        $private = Type::where('id', '1')->first();
        $kelompok = Type::where('id', '2')->first();


        if (request()->ajax()) {
            $req = $request->type;
            if (request()->input('type') != 0) {
                $query = SiswaKursus::with(['siswa', 'kursus_unit.kursus', 'kursus_unit.unit', 'kursus_unit.type'])
                    ->whereHas(
                        'kursus_unit.unit',
                        function ($q) use ($unit_id) {
                            $q->where('unit_id', $unit_id);
                        }
                    )
                    ->whereHas(
                        'kursus_unit.type',
                        function ($q) use ($req) {
                            $q->where('type_id', $req);
                        }
                    )
                    ->where(function ($q) {
                        $q->where('status_sertifikat', 'lulus')
                            ->orWhere('status_sertifikat', 'sertifikat');
                    })
                    ->groupBy('siswa_id', 'kursus_unit_id')
                    ->latest();
            } else {
                $query = SiswaKursus::with(['siswa', 'kursus_unit.kursus', 'kursus_unit.unit', 'kursus_unit.type'])
                    ->whereHas('kursus_unit.unit', function ($q) use ($unit_id) {
                        $q->where('unit_id', $unit_id);
                    })
                    ->where(function ($q) {
                        $q->where('status_sertifikat', 'lulus')
                            ->orWhere('status_sertifikat', 'sertifikat');
                    })
                    ->groupBy('siswa_id', 'kursus_unit_id')
                    ->latest();
            }

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
                ->addColumn('type', function ($item) {
                    return ucwords($item->kursus_unit->type->nama_type ?? '');
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
                ->rawColumns(['action', 'foto', 'status'])
                ->make();
        }

        return view('admin.siswa_unit.detail', [
            'unit'  => $unit,
            'type'  => $type,
            'private' => $private,
            'kelompok' => $kelompok
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

    public function export_kelompok($id, $type)
    {
        $unit = KursusUnit::with('unit', 'kursus')
            ->where('unit_id', $id)->first();
        return Excel::download(
            new SiswaKelompok($id, $type),
            'Laporan-Siswa-Kelompok-Unit-' . $unit->unit->nama_unit .  '-' . now() . '.xlsx'
        );
    }

    public function export_private($id, $type)
    {
        $unit = KursusUnit::with('unit', 'kursus')
            ->where('unit_id', $id)->first();
        return Excel::download(
            new SiswaPrivate($id, $type),
            'Laporan-Siswa-Private-Unit-' . $unit->unit->nama_unit .  '-' . now() . '.xlsx'
        );
    }
}
