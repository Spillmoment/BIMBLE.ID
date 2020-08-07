<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kursus;
use App\Http\Requests\KursusRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KursusController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('admin.kursus.index', ['kursus' => Kursus::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kursus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KursusRequest $request)
    {
        $kursus = $request->all();
        $nama_kursus = $kursus['nama_kursus'];

        $kursus['slug'] = Str::slug($nama_kursus, '-');
        $kursus['gambar_kursus'] = $request->file('gambar_kursus')->store('kursus', 'public');

        Kursus::create($kursus);
        return redirect()->route('kursus.index')
            ->with(['status' => 'Data Kursus Berhasil Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Kursus $kursus)
    {
        return view('admin.kursus.show', compact('kursus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kursus $kursus)
    {
        return view('admin.kursus.edit', compact('kursus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(KursusRequest $request, Kursus $kursus)
    {
        $data = $request->all();
        $nama_kursus = $data['nama_kursus'];
        $data['slug'] = Str::slug($nama_kursus, '-');

        if ($request->hasFile('gambar_kursus')) {
            if ($kursus->gambar_kursus && file_exists(storage_path('app/public/' . $kursus->gambar_kursus))) {
                Storage::delete('public/' . $kursus->gambar_kursus);
                $data['gambar_kursus'] =  $request->file('gambar_kursus')->store('kursus', 'public');
            }
        }

        $kursus->update($data);
        return redirect()->route('kursus.index')->with(['status' => 'Data Kursus Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kursus $kursus)
    {
        Storage::delete('public/' . $kursus->gambar_kursus);
        $kursus->forceDelete();
        return redirect()->route('kursus.index')
            ->with(['status' => 'Data Kursus Berhasil Dihapus']);
    }
}
