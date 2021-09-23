<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Http\Requests\KategoriRequest;
use Illuminate\Support\Str;

class KategoriController extends Controller
{

    public function index()
    {
        return view('admin.kategori.index', [
            'kategori' => Kategori::latest()->get()
        ]);
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
