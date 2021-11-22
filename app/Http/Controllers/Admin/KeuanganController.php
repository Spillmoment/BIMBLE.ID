<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Keuangan;
use Yajra\DataTables\Facades\DataTables;

class KeuanganController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Keuangan::query()->latest();
            return DataTables::of($query)
                ->addColumn('action', function ($item){
                    return view('admin.keuangan.action', compact('item'));
                })
                ->editColumn('created_at', function ($item){
                    return $item->created_at->format('d M Y');
                })
                ->addColumn('unit', function ($item) {
                    return $item->unit->nama_unit ?? '';
                })
                ->addColumn('rule_gaji_lppk', function ($item) {
                    return $item->rule_gaji->lppk ?? '';
                })
                ->addColumn('rule_gaji_unit', function ($item) {
                    return $item->rule_gaji->unit ?? '';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.keuangan.index');
    }

    public function update_status($id)
    {
        $keuangan = Keuangan::findOrFail($id);
        if ($keuangan->status == 'inactive') {
            $keuangan->update([
                    'status' => 'active',
                ]);
            
            return redirect()->route('keuangan.index')
                ->with('status', 'Permintaan berhasil diupdate');
        }else{
            $keuangan->update([
                'status' => 'inactive',
            ]);

            return redirect()->route('keuangan.index')
                ->with('status', 'Status diurungkan !');
        }
    }

}
