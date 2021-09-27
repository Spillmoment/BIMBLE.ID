<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Unit;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class PendaftarUnitController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Unit::query()->where('status', '2')->latest();
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return
                        '<div class="btn-group">
                            <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="icon icon-sm">
                                    <span class="fas fa-ellipsis-h icon-dark"></span>
                                </span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                <a class="dropdown-item" href="' . route('pendaftar-unit.show', $item->id) . '"><span
                                        class="fas fa-eye mr-2"></span>Detail</a>
                                <form action="' . route('pendaftar-unit.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button id="deleteButton" type="submit" class="dropdown-item text-danger" data-name="' . $item->nama_unit .  '">
                                        <span class="fas fa-trash-alt mr-2"></span>Hapus</a>
                                    </button>
                                </form>
                            </div>
                        </div>';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.pendaftar.index');
    }

    public function create()
    {
        abort(404);
    }


    public function store()
    {
        abort(404);
    }


    public function show($id)
    {
        return view('admin.pendaftar.show', [
            'unit' => Unit::findOrFail($id)
        ]);
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
