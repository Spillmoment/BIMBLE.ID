<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnitRequest;
use App\Unit;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Unit\UnitExports;
use PDF;

class UnitController extends Controller
{
    public function index()
    {
        $unit = Unit::where('status', '1')
            ->orWhere('status', '0')
            ->groupBy('status')
            ->get();

        if (request()->ajax()) {

            $query = Unit::where('status', '1')
                ->orWhere('status', '0')
                ->latest()
                ->get();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return view('admin.unit.action', compact('item'));
                })
                ->editColumn('status', function ($item) {
                    if ($item->status == '1') {
                        return '<button class="btn btn-primary btn-sm">Aktif</button>';
                    } else {
                        return '<button class="btn btn-danger btn-sm">Nonaktif</button>';
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make();
        }

        return view('admin.unit.index', compact('unit'));
    }

    public function create()
    {
        return view('admin.unit.create');
    }


    public function store(UnitRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        Unit::create($data);
        return redirect()->route('unit.index')
            ->with(['status' => 'Data Unit Berhasil Ditambahkan']);
    }


    public function show(Unit $unit)
    {
        return view('admin.unit.show', compact('unit'));
    }


    public function edit(Unit $unit)
    {
        return view('admin.unit.edit', compact('unit'));
    }


    public function update(UnitRequest $request, Unit $unit)
    {

        $data = $request->all();

        if ($request->input('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data = Arr::except($data, ['password']);
        }

        $unit->update($data);
        return redirect()->route('unit.index')->with([
            'status' => 'Data unit Berhasil Di Update'
        ]);
    }

    public function destroy(Unit $unit)
    {
        Storage::delete('public/' . $unit->gambar_unit);
        $unit->forceDelete();
        return redirect()->route('unit.index')
            ->with(['status' => 'Data unit Berhasil Dihapus']);
    }

    public function export_excel()
    {
        $tgl = now();
        return Excel::download(new UnitExports, 'Laporan-Unit-' . $tgl . '.xlsx');
    }

    public function export_pdf()
    {
        $tgl = now();
        $unit = Unit::where('status', '1')
            ->orWhere('status', '0')
            ->latest()->get();
        $pdf = PDF::loadview('admin.unit.pdf', ['unit' => $unit])
            ->setPaper('F4', 'landscape');
        return $pdf->download('laporan-unit-' . $tgl . '.pdf');
    }
}
