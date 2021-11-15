<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\KursusUnit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class UnitKursusController extends Controller
{
    public function index()
    {

        $kursus_unit = KursusUnit::with(['unit', 'kursus'])
            ->groupBy('unit_id')
            ->latest()
            ->get();

        return view('admin.unit_kursus.index', [
            'query' => $kursus_unit
        ]);
    }

    public function detail($id)
    {

        $unit = KursusUnit::with(['unit', 'kursus.kategori'])
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
                ->rawColumns(['kursus', 'kategori', 'gambar_kursus', 'biaya_kursus'])
                ->make();
        }

        return view('admin.unit_kursus.detail', [
            'unit' => $unit
        ]);
    }
}
