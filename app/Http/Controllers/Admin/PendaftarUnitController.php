<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Unit\UnitPendaftarExports;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Unit;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class PendaftarUnitController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Unit::query()->where('status', '2')->latest();
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return view('admin.pendaftar.action', compact('item'));
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.pendaftar.index');
    }


    public function show($id)
    {
        return view('admin.pendaftar.show', [
            'unit' => Unit::findOrFail($id)
        ]);
    }


    public function setStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1,2'
        ]);

        $item = Unit::findOrFail($id);
        $item->status = $request->status;

        $item->save();
        return redirect()->route('pendaftar-unit.index')->with([
            'success' => 'Data Pendaftar Unit telah disetujui, Silahkan update data di Unit'
        ]);
    }

    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        File::delete('storage/file/' . $unit->bukti_alumni);
        $unit->forceDelete();
        return redirect()->route('pendaftar-unit.index')
            ->with(['status' => 'Data Pendaftar Unit Berhasil Dihapus']);
    }

    public function download($file)
    {
        $file_path = public_path('storage/file/' . $file);
        return response()->download($file_path);
    }

    public function export_excel()
    {
        $tgl = now();
        return Excel::download(new UnitPendaftarExports, 'laporan-pendaftar-unit-' . $tgl . '.xlsx');
    }

    public function export_pdf()
    {
        $tgl = now();
        $unit = Unit::where('status', '2')->latest()->get();
        $pdf = PDF::loadview('admin.pendaftar.pdf', ['unit' => $unit]);
        return $pdf->download('laporan-pendaftar-unit-' . $tgl . '.pdf');
    }
}
