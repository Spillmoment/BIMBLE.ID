<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use App\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SalaryController extends Controller
{
    public function index(Request $request)
    {      
        $status = Keuangan::with(['rule_gaji','unit'])
            ->where('status', 'active')
            ->orWhere('status', 'inactive')
            ->groupBy('status')
            ->get();
        // dd($status);
        if (request()->ajax()) {

            $query = Keuangan::with(['rule_gaji','unit'])
                ->where('unit_id', Auth::id())
                ->latest()
                ->get();
            
            return DataTables::of($query)
                ->editColumn('created_at', function ($item){
                    return $item->created_at->format('d M Y');
                })
                ->addColumn('rule_gaji_lppk', function ($item) {
                    return $item->rule_gaji->lppk.'%' ?? '';
                })
                ->addColumn('rule_gaji_unit', function ($item) {
                    return $item->rule_gaji->unit.'%' ?? '';
                })
                ->editColumn('nominal', function ($item){
                    return 'Rp. '.number_format($item->nominal, 0, ',', '.');
                })
                ->editColumn('status', function ($item) {
                    if ($item->status == 'active') {
                        return '<span class="badge bg-success">Terbayar</span>';
                    } else {
                        return '<span class="badge bg-primary">Belum</span>';
                    }
                })
                ->rawColumns(['created_at', 'nominal', 'status'])
                ->make(true);
        }
        
        return view('unit.salary.index', compact('status'));
    }
}
