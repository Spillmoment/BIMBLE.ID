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
                                <a class="dropdown-item" href="' . route('gallery.show', $item->id) . '"><span
                                        class="fas fa-eye mr-2"></span>Detail</a>
                                <a class="dropdown-item" href="' . route('gallery.edit', $item->id) . '"><span
                                        class="fas fa-edit mr-2"></span>Sunting</a>
                                <form action="' . route('gallery.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button id="deleteButton" type="submit" class="dropdown-item text-danger" data-name="' . $item->kursus->nama_kursus .  '">
                                        <span class="fas fa-trash-alt mr-2"></span>Hapus</a>
                                    </button>
                                </form>
                            </div>
                        </div>';
                })
                ->addColumn('kursus', function ($item) {
                    return $item->kursus->nama_kursus;
                })
                ->editColumn('gambar', function ($item) {
                    foreach (explode('|', $item->gambar) as $image) {
                        return '<img src="/storage/image/' . $image . '" style="max-height: 40px;">';
                    }
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
