<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use Illuminate\Support\Facades\File;

class PendUnitController extends Controller
{

    public function index()
    {
        return view('admin.pendaftar.index', [
            'unit' => Unit::where('status', '2')
                ->latest()->get()
        ]);
    }

    public function create()
    {
        abort(404);
    }


    public function store()
    {
        abort(404);
    }


    public function show()
    {
        abort(404);
    }


    public function edit()
    {
        abort(404);
    }


    public function update()
    {
        abort(404);
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
}
