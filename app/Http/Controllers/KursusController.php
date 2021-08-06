<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kursus;
use App\Http\Requests\KursusRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\GaleriKursus;

class KursusController extends Controller
{

    public function index()
    {
        return view('admin.kursus.index', ['kursus' => Kursus::latest()->get()]);
    }


    public function create()
    {
        return view('admin.kursus.create');
    }


    public function store(KursusRequest $request)
    {
        $kursus = $request->all();
        $nama_kursus = $kursus['nama_kursus'];

        $kursus['slug'] = Str::slug($nama_kursus, '-');
        $kursus['gambar_kursus'] = $request->file('gambar_kursus')->store('kursus', 'public');
        $kursus['status'] = 'aktif';

        Kursus::create($kursus);
        return redirect()->route('kursus.index')
            ->with(['status' => 'Data Kursus Berhasil Ditambahkan']);
    }


    public function show(Kursus $kursus)
    {
        return view('admin.kursus.show', compact('kursus'));
    }


    public function edit(Kursus $kursus)
    {
        return view('admin.kursus.edit', compact('kursus'));
    }



    public function update(KursusRequest $request, Kursus $kursus)
    {
        $data = $request->all();
        $nama_kursus = $data['nama_kursus'];
        $data['slug'] = Str::slug($nama_kursus, '-');

        if ($request->hasFile('gambar_kursus')) {
            if ($kursus->gambar_kursus && file_exists(storage_path('app/public/' . $kursus->gambar_kursus))) {
                Storage::delete('public/' . $kursus->gambar_kursus);
                $data['gambar_kursus'] =  $request->file('gambar_kursus')->store('kursus', 'public');
            } else {
                $data['gambar_kursus'] =  $request->file('gambar_kursus')->store('kursus', 'public');
            }
        }

        $kursus->update($data);
        return redirect()->route('kursus.index')->with(['status' => 'Data Kursus Berhasil Di Update']);
    }


    public function destroy(Kursus $kursus)
    {
        Storage::delete('public/' . $kursus->gambar_kursus);
        $kursus->forceDelete();
        return redirect()->route('kursus.index')
            ->with(['status' => 'Data Kursus Berhasil Dihapus']);
    }

    public function gallery($id)
    {
        $kursus = Kursus::with('galleries')
            ->findorFail($id);

        $gallery = GaleriKursus::with('kursus')
            ->where('kursus_id', $id)
            ->orderBy('created_at', 'DESC')
            ->paginate(9);

        return view('admin.kursus.gallery')->with([
            'kursus' => $kursus,
            'items' => $gallery
        ]);
    }
}
