<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Kategori;
use App\Http\Requests\KategoriRequest;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;


class KategoriController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Kategori::query()->latest();
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
                                <a class="dropdown-item" href="' . route('kategori.edit', $item->id) . '"><span
                                        class="fas fa-edit mr-2"></span>Sunting</a>
                                <form action="' . route('kategori.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button id="deleteButton" type="submit" class="dropdown-item text-danger" data-name="' . $item->nama_kategori .  '">
                                        <span class="fas fa-trash-alt mr-2"></span>Hapus</a>
                                    </button>
                                </form>
                            </div>
                        </div>';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.kategori.index');
    }


    public function create()
    {
        return view('admin.kategori.create');
    }


    public function store(KategoriRequest $request)
    {
        $data = $request->all();
        $nama_kat = $data['nama_kategori'];
        $data['slug'] = Str::slug($nama_kat, '-');
        Kategori::create($data);

        return redirect()->route('kategori.index')
            ->with('status', 'Kategori berhasil ditambahkan');
    }


    public function show(Kategori $kategori)
    {
        //
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }


    public function update(KategoriRequest $request, Kategori $kategori)
    {
        $data = $request->all();
        $nama_kat = $data['nama_kategori'];
        $data['slug'] = Str::slug($nama_kat, '-');

        $kategori->update($data);
        return redirect()->route('kategori.index')
            ->with('status', 'Kategori berhasil diupdate');
    }


    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return back()->with('status', 'Kategori berhasil dihapus');
    }
}
