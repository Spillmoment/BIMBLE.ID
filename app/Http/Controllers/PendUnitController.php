<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PendUnitController extends Controller
{

    public function index(Request $request)
    {
        return view('admin.pendaftar.index', [
            'unit' => Unit::where('status', '2')
                ->latest()->get()
        ]);
    }

    public function create()
    {
        return view('admin.unit.create');
    }


    public function store(Request $request)
    {
    }


    public function show(Unit $unit)
    {
    }


    public function edit(Unit $unit)
    {
        return view('admin.unit.edit', compact('unit'));
    }


    public function update(Request $request)
    {
    }

    public function setStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1'
        ]);

        $item = Unit::findOrFail($id);
        $item->status = $request->status;

        $item->save();
        return redirect()->route('pendaftar.index')->with([
            'success' => 'Data Pendaftar Unit telah disetujui, Silahkan update data di Unit'
        ]);
    }

    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->forceDelete();
        Storage::delete('public/' . $unit->bukti_alumni);
        return redirect()->route('pendaftar.index')
            ->with(['status' => 'Data Pendaftar Unit Berhasil Dihapus']);
    }
}
