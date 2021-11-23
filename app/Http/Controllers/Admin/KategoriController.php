<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Kategori;
use App\Http\Requests\KategoriRequest;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;


class KategoriController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Kategori::query()->latest();
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return view('admin.kategori.action', compact('item'));
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

        Alert::success('Success', 'Kategori berhasil ditambahkan')
            ->autoClose(3000);
        return redirect()->route('kategori.index');
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
        Alert::success('Success', 'Kategori berhasil diupdate')
            ->autoClose(3000);;
        return redirect()->route('kategori.index');
    }


    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        Alert::success('Success', 'Kategori berhasil dihapus')
            ->autoClose(3000);;
        return back();
    }
}
