<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UnitKursus\KursusKelompok;
use App\Exports\UnitKursus\KursusPrivate;
use App\Http\Controllers\Controller;
use App\Kursus;
use App\KursusUnit;
use App\Type;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class UnitKursusController extends Controller
{
    public function index()
    {
        $kursus_unit = KursusUnit::with(['unit', 'kursus'])
            ->groupBy('unit_id')
            ->latest()
            ->paginate(6);

        return view('admin.unit_kursus.index', [
            'query' => $kursus_unit
        ]);
    }

    public function detail(Request $request, $id)
    {

        $unit = KursusUnit::with(['unit', 'kursus.kategori', 'type'])
            ->where('unit_id', $id)->first();

        $type = Type::latest()->get();
        $private = Type::where('id', '1')->first();
        $kelompok = Type::where('id', '2')->first();

        if (request()->ajax()) {

            if ($request->input('type') != 0) {
                $query = KursusUnit::query()
                    ->with(['unit', 'kursus.kategori', 'type'])
                    ->where('unit_id', $id)
                    ->where('type_id', $request->type)
                    ->latest();
            } else {
                $query = KursusUnit::query()
                    ->with(['unit', 'kursus.kategori', 'type'])
                    ->where('unit_id', $id)
                    ->where('type_id', '2')
                    ->latest();
            }

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '<a class="btn btn-primary btn-sm" href="' . route('unit-kursus.detail-kursus', $item->id) . '"><span
                    class="fas fa-eye"></span> Detail</a>';
                })
                ->addColumn('kursus', function ($item) {
                    return $item->kursus->nama_kursus;
                })
                ->addColumn('type', function ($item) {
                    return ucwords($item->type->nama_type);
                })
                ->addColumn('kategori', function ($item) {
                    return $item->kursus->kategori->nama_kategori;
                })
                ->editColumn('biaya_kursus', function ($item) {
                    return 'Rp.' . number_format($item->biaya_kursus);
                })
                ->editColumn('status', function ($item) {
                    if ($item->status == 'aktif') {
                        return '<button class="btn btn-success btn-sm">Aktif</button>';
                    } else {
                        return '<button class="btn btn-danger btn-sm">Nonaktif</button>';
                    }
                })
                ->rawColumns(['action', 'biaya_kursus', 'status'])
                ->make();
        }

        return view('admin.unit_kursus.detail', [
            'unit' => $unit,
            'type' => $type,
            'private' => $private,
            'kelompok' => $kelompok
        ]);
    }

    public function detail_kursus($id)
    {
        $kursus_unit = KursusUnit::with(['kursus', 'unit'])
            ->findOrFail($id);
        return view('admin.unit_kursus.detail_kursus', compact('kursus_unit'));
    }

    public function export_kelompok($id, $type)
    {
        $unit = KursusUnit::with('unit', 'kursus')
            ->where('unit_id', $id)->first();
        return Excel::download(
            new KursusKelompok($id, $type),
            'Laporan-Siswa-Kelompok-Unit-' . $unit->unit->nama_unit .  '-' . now() . '.xlsx'
        );
    }

    public function export_private($id, $type)
    {
        $unit = KursusUnit::with('unit', 'kursus')
            ->where('unit_id', $id)->first();
        return Excel::download(
            new KursusPrivate($id, $type),
            'Laporan-Siswa-Private-Unit-' . $unit->unit->nama_unit .  '-' . now() . '.xlsx'
        );
    }

    public function export_pdf_kelompok($id, $type)
    {
        $kursus_unit = KursusUnit::with(['unit', 'kursus.kategori'])
            ->where('unit_id', $id)->first();

        $query = KursusUnit::with(['unit', 'kursus'])
            ->where('unit_id', $id)
            ->where('type_id', $type)
            ->latest()
            ->get();

        $pdf = PDF::loadview('admin.unit_kursus.pdf_kelompok', compact('kursus_unit', 'query'));
        return $pdf->download('Laporan-Kursus-Kelompok-Unit-' .
            $kursus_unit->unit->nama_unit . '-' . now() . '.pdf');
    }

    public function export_pdf_private($id, $type)
    {
        $kursus_unit = KursusUnit::with(['unit', 'kursus.kategori'])
            ->where('unit_id', $id)->first();

        $query = KursusUnit::with(['unit', 'kursus'])
            ->where('unit_id', $id)
            ->where('type_id', $type)
            ->latest()
            ->get();

        $pdf = PDF::loadview('admin.unit_kursus.pdf_private', compact('kursus_unit', 'query'));
        return $pdf->download('Laporan-Kursus-Private-Unit-' .
            $kursus_unit->unit->nama_unit . '-' . now() . '.pdf');
    }
}
