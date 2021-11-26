<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\GaleriKursus;
use App\Kursus;
use App\Http\Requests\GalleryRequest;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class GalleryController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = GaleriKursus::query()->with(['kursus'])->latest();
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return view('admin.gallery.action', compact('item'));
                })
                ->addColumn('kursus', function ($item) {
                    return $item->kursus->nama_kursus;
                })
                ->editColumn('gambar', function ($item) {
                    return view('admin.gallery.image', compact('item'));
                })
                ->rawColumns(['action', 'kursus', 'gambar'])
                ->make();
        }
        return view('admin.gallery.index');
    }


    public function create()
    {
        $kursus = Kursus::all();
        return view('admin.gallery.create', [
            'kursus' => $kursus
        ]);
    }


    public function store(GalleryRequest $request)
    {
        $input = $request->all();
        $images = array();

        if ($files = $request->file('gambar')) {
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $file->move('storage/image', $name);
                $images[] = $name;
            }
        }

        GaleriKursus::insert([
            'kursus_id' => $input['kursus_id'],
            'gambar' =>  implode("|", $images),
        ]);

        return redirect()->route('gallery.index')
            ->with(['status' => 'Data Gallery Berhasil Ditambahkan']);
    }


    public function show($id)
    {
        $gallery = GaleriKursus::findOrFail($id);

        return view('admin.gallery.show', [
            'item' => $gallery,
        ]);
    }


    public function edit($id)
    {
        $gallery = GaleriKursus::findOrFail($id);
        $kursus = Kursus::all();

        return view('admin.gallery.edit', [
            'gallery' => $gallery,
            'kursus' => $kursus
        ]);
    }


    public function update(GalleryRequest $request, $id)
    {
        $gallery = GaleriKursus::findOrFail($id);
        $data = $request->all();

        $images = array();

        if (empty($data['gambar'])) {
            if ($files = $request->file('gambar')) {
                foreach ($files as $file) {
                    $name = $file->getClientOriginalName();
                    $file->move('storage/image', $name);
                    $images[] = $name;
                }
            }
        } else {
            $data['gambar'] = $gallery->gambar;
        }

        $gallery->update([
            'kursus_id' => $data['kursus_id'],
            'gambar' =>  implode("|", $images),
        ]);

        return redirect()->route('gallery.index')
            ->with(['status' => 'Data Gallery Berhasil Diubah']);
    }


    public function destroy($id)
    {
        $gallery = GaleriKursus::findOrFail($id);
        // File::delete('/storage/image/' . $gallery->gambar);

        $images = explode(",", $gallery->gambar);
        foreach ($images as $image) {
            $image_path = public_path() . 'storage/image/' . $image;
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        $gallery->delete();

        return redirect()->route('gallery.index')
            ->with(['status'  => 'Data Gallery Berhasil Dihapus']);
    }
}
