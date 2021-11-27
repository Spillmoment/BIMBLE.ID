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
use RealRashid\SweetAlert\Facades\Alert;

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
                    ->whereHas('kursus_unit.unit', function ($q) use ($unit_id) {
                        $q->where('unit_id', $unit_id);
                    })
                    ->whereHas('kursus_unit.type', function ($q) use ($req) {
                        $q->where('type_id', $req);
                    })
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
                    return view('admin.siswa_unit.action', compact('item'));
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

    public function detail_siswa_id($id)
    {
        $data = SiswaKursus::with(['siswa', 'kursus_unit'])
            ->findOrFail($id);
        return view('admin.siswa_unit.detail_siswa', compact('data'));
    }

    public function destroy($id)
    {
        $data = SiswaKursus::with(['siswa', 'kursus_unit'])->find($id);
        Storage::delete('public/sertifikat/' . $data->file);
        $data->delete();

        Alert::success('Success', 'Siswa Berhasil Di Hapus')
            ->autoClose(3000);
        return back();
    }

    public function confirm($id)
    {
        $data = SiswaKursus::with(['siswa', 'kursus_unit'])->find($id);
        $pdf = PDF::loadView('admin.siswa_unit.pdf_sertif', compact('data'))
            ->setPaper('F4', 'landscape');
        $filename = $data->siswa->nama_siswa . '-' . date('dmyHis') . '.pdf';
        Storage::put('public/sertifikat/' . $filename, $pdf->output());

        SiswaKursus::where('id', $id)
            ->update([
                'status_sertifikat' => 'sertifikat',
                'sertifikat' => $filename
            ]);

        Alert::success('Success', 'Sertifikat Siswa Berhasil Di Konfirmasi')
            ->autoClose(3000);
        return back();
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


        Alert::success('Success', 'Sertifikat Siswa Berhasil Di Batalkan')
            ->autoClose(3000);
        return back();
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

    public function export_pdf($id, $type)
    {
        $kursus_unit = KursusUnit::with('unit', 'kursus')
            ->where('type_id', $type)
            ->where('unit_id', $id)->first();

        $query = SiswaKursus::with([
            'siswa', 'kursus_unit.kursus', 'kursus_unit.unit',
            'kursus_unit.type'
        ])
            ->whereHas('kursus_unit.unit', function ($query) use ($id) {
                $query->where('unit_id', $id);
            })
            ->whereHas('kursus_unit.type', function ($query) use ($type) {
                $query->where('type_id', $type);
            })
            ->where(function ($query) {
                $query
                    ->where('status_sertifikat', 'lulus')
                    ->orWhere('status_sertifikat', 'sertifikat');
            })
            ->groupBy('siswa_id', 'kursus_unit_id')
            ->latest()
            ->get();

        $pdf = PDF::loadview('admin.siswa_unit.pdf_siswa', compact('kursus_unit', 'query'))
            ->setPaper('F4', 'landscape');;
        return $pdf->download('Laporan-Siswa-' . $kursus_unit->type->nama_type . '-Unit-' .
            $kursus_unit->unit->nama_unit . '-' . now() . '.pdf');
    }
}
