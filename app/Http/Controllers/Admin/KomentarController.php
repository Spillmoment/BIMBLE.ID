<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Kursus\KomentarExports;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Komentar;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class KomentarController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Komentar::query()->with(['kursus_unit.unit', 'kursus_unit.kursus'])
                ->latest();
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return view('admin.komentar.action', compact('item'));
                })
                ->addColumn('kursus', function ($item) {
                    return $item->kursus_unit->map(function ($kur) {
                        return $kur->kursus->nama_kursus;
                    })->implode("");
                })
                ->addColumn('unit', function ($item) {
                    return $item->kursus_unit->map(function ($kur) {
                        return $kur->unit->nama_unit;
                    })->implode("");
                })
                ->rawColumns(['action', 'kursus', 'unit'])
                ->make();
        }

        return view('admin.komentar.index');
    }


    public function show($id)
    {
        return view('admin.komentar.show', [
            'komentar' => Komentar::findOrFail($id)
        ]);
    }

    public function destroy(Komentar $komentar)
    {
        $komentar->delete();
        return redirect()->route('komentar.index')->with([
            'status' => 'Data Komentar Berhasil Dihapus!'
        ]);
    }

    public function export_excel()
    {
        $tgl = now();
        return Excel::download(new KomentarExports, 'Laporan-Komentar-' . $tgl . '.xlsx');
    }

    public function export_pdf()
    {
        $tgl = now();
        $komentar = Komentar::latest()->get();
        $pdf = PDF::loadview('admin.komentar.pdf', ['komentar' => $komentar]);
        return $pdf->download('laporan-komentar-' . $tgl . '.pdf');
    }
}
