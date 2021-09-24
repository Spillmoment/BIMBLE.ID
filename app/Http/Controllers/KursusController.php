<?php

namespace App\Http\Controllers;

use App\Kursus;
use App\Http\Requests\KursusRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\GaleriKursus;
use App\Kategori;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

class KursusController extends Controller
{

    public function index()
    {
        $kursus = Kursus::with(['kategori'])->latest()->get();
        return view('admin.kursus.index', [
            'kursus' => $kursus
        ]);
    }

    public function create()
    {
        $kategori = Kategori::latest()->get();
        return view('admin.kursus.create', [
            'kategori' => $kategori
        ]);
    }

    public function store(KursusRequest $request)
    {
        $data = $request->all();
        $nama_kursus = $data['nama_kursus'];

        $data['slug'] = Str::slug($nama_kursus, '-');
        $data['gambar_kursus'] = $request->file('gambar_kursus');
        $nama_gambar = rand(1, 999) . "-" . $data['gambar_kursus']->getClientOriginalName();
        $data['gambar_kursus'] = Image::make($data['gambar_kursus']->getRealPath());
        $data['gambar_kursus']->resize(500, 300)->save(public_path('assets/images/kursus/' . $nama_gambar));;
        $data['gambar_kursus'] = $nama_gambar;
        $data['status'] = 'aktif';

        Kursus::create($data);
        return redirect()->route('kursus.index')
            ->with(['status' => 'Data Kursus Berhasil Ditambahkan']);
    }

    public function show()
    {
    }

    public function edit($id)
    {
        $kategori = Kategori::latest()->get();
        return view('admin.kursus.edit', [
            'kategori' => $kategori,
            'kursus'   => Kursus::findOrFail($id)
        ]);
    }


    public function update(KursusRequest $request, $id)
    {
        $kursus = Kursus::findOrFail($id);
        $data = $request->all();
        $nama_kursus = $data['nama_kursus'];
        $data['slug'] = Str::slug($nama_kursus, '-');

        if (!empty($data['gambar_kursus'])) {
            File::delete(public_path('assets/images/kursus/' . $kursus->gambar_kursus));
            $nama_foto = rand(1, 999) . "-" . $data['gambar_kursus']->getClientOriginalName();
            $data['gambar_kursus'] = Image::make($data['gambar_kursus']->getRealPath());
            $data['gambar_kursus']->resize(500, 300);
            $data['gambar_kursus']->save(public_path('assets/images/kursus/' . $nama_foto));
            $data['gambar_kursus'] = $nama_foto;
        }

        $kursus->update($data);
        return redirect()->route('kursus.index')->with(['status' => 'Data Kursus Berhasil Di Update']);
    }


    public function destroy($id)
    {
        $kursus = Kursus::findOrFail($id);
        File::delete(public_path('assets/images/kursus/' . $kursus->gambar_kursus));
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
