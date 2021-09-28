<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Komentar;
use Yajra\DataTables\Facades\DataTables;

class KomentarController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Komentar::query()->with(['kursus_unit'])
                ->latest();
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
                                <a class="dropdown-item" href="' . route('komentar.show', $item->id) . '"><span
                                class="fas fa-eye mr-2"></span>Detail</a>  
                                 <form action="' . route('komentar.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button id="deleteButton" type="submit" class="dropdown-item text-danger" data-name="' . $item->nama .  '">
                                        <span class="fas fa-trash-alt mr-2"></span>Hapus</a>
                                    </button>
                                </form>
                            </div>
                        </div>';
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
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.komentar.index');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('admin.komentar.show', [
            'komentar' => Komentar::findOrFail($id)
        ]);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Komentar $komentar)
    {
        $komentar->delete();
        return redirect()->route('komentar.index')->with([
            'status' => 'Data Komentar Berhasil Dihapus!'
        ]);
    }
}
