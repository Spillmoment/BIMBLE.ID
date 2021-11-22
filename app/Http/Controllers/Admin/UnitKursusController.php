<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UnitKursusExports;
use App\Http\Controllers\Controller;
use App\KursusUnit;
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

    public function detail($id)
    {

        $unit = KursusUnit::with(['unit', 'kursus.kategori', 'type'])
            ->where('unit_id', $id)->first();

        if (request()->ajax()) {

            $query = KursusUnit::query()
                ->with(['unit', 'kursus.kategori'])
                ->where('unit_id', $id)
                ->where('type_id', '2')
                ->latest();

            return DataTables::of($query)
                ->addColumn('kursus', function ($item) {
                    return $item->kursus->nama_kursus;
                })
                ->addColumn('type', function ($item) {
                    return ucwords($item->type->nama_type);
                })
                ->addColumn('kategori', function ($item) {
                    return $item->kursus->kategori->nama_kategori;
                })
                ->addColumn('gambar_kursus', function ($item) {
                    if (!empty($item->kursus->gambar_kursus)) {
                        return '<img src="' . url('assets/images/kursus/' . $item->kursus->gambar_kursus) . '" style="max-height: 40px;"/>';
                    } else {
                        return 'N/A';
                    }
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
                ->rawColumns(['gambar_kursus', 'biaya_kursus', 'status'])
                ->make();
        }

        return view('admin.unit_kursus.detail', [
            'unit' => $unit
        ]);
    }

    public function export_excel($id)
    {
        $kursus_unit = KursusUnit::with(['unit', 'kursus.kategori'])
            ->where('unit_id', $id)->first();
        return Excel::download(
            new UnitKursusExports($id),
            'Laporan-Kursus-Unit-' . $kursus_unit->unit->nama_unit .  '-' . now() . '.xlsx'
        );
    }

    public function export_pdf($id)
    {
        $kursus_unit = KursusUnit::with(['unit', 'kursus.kategori'])
            ->where('unit_id', $id)->first();

        $query = KursusUnit::with(['unit', 'kursus'])
            ->where('unit_id', $id)
            ->where('type_id', '2')
            ->latest()
            ->get();

        $pdf = PDF::loadview('admin.unit_kursus.pdf', compact('kursus_unit', 'query'));
        return $pdf->download('Laporan-Kursus-Unit-' .
            $kursus_unit->unit->nama_unit . '-' . now() . '.pdf');
    }
}
