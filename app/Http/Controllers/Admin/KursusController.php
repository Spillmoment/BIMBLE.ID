<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Kursus;
use App\Http\Requests\KursusRequest;
use Illuminate\Support\Str;
use App\GaleriKursus;
use App\Kategori;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class KursusController extends Controller
{
    public function index()
    {

        if (request()->ajax()) {
            $query = Kursus::query()->with(['kategori'])->latest();
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
                                <a class="dropdown-item" href="' . route('kursus.show', $item->id) . '"><span
                                        class="fas fa-eye mr-2"></span>Detail</a>
                                <a class="dropdown-item" href="' . route('kursus.edit', $item->id) . '"><span
                                        class="fas fa-edit mr-2"></span>Sunting</a>
                                <a class="dropdown-item" href="' . route('kursus.gallery', $item->id) . '"><span class="fas fa-images mr-2"></span>Galeri</a>
                                <form action="' . route('kursus.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button id="deleteButton" type="submit" class="dropdown-item text-danger" data-name="' . $item->nama_kursus .  '">
                                        <span class="fas fa-trash-alt mr-2"></span>Hapus</a>
                                    </button>
                                </form>
                            </div>
                        </div>';
                })
                ->addColumn('kategori', function ($item) {
                    return $item->kategori->nama_kategori;
                })
                ->editColumn('gambar_kursus', function ($item) {
                    return '<img src="' . url('assets/images/kursus/' . $item->gambar_kursus) . '" style="max-height: 40px;"/>';
                })
                ->rawColumns(['action', 'gambar_kursus'])
                ->make();
        }

        return view('admin.kursus.index');
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
        $data['gambar_kursus']->resize(500, 300)->save(public_path('assets/images/kursus/' . $nama_gambar));
        $data['gambar_kursus'] = $nama_gambar;

        $data['background'] = $request->file('gambar_kursus');
        $nama_back = rand(1, 999) . "-" . $data['background']->getClientOriginalName();
        $data['background'] = Image::make($data['background']->getRealPath());
        $data['background']->resize(1000, 1000)->save(public_path('assets/images/background-kursus/' . $nama_back));
        $data['background'] = $nama_back;

        $data['status'] = 'aktif';


        Kursus::create($data);
        return redirect()->route('kursus.index')
            ->with(['status' => 'Data Kursus Berhasil Ditambahkan']);
    }

    public function show($id)
    {
        $kursus = Kursus::findOrFail($id);
        return view('admin.kursus.show', [
            'kursus' => $kursus
        ]);
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
            File::delete(public_path('assets/images/background-kursus/' . $kursus->background));

            $nama_foto = rand(1, 999) . "-" . $data['gambar_kursus']->getClientOriginalName();
            $data['gambar_kursus'] = Image::make($data['gambar_kursus']->getRealPath());
            $data['gambar_kursus']->resize(500, 300);
            $data['gambar_kursus']->save(public_path('assets/images/kursus/' . $nama_foto));
            $data['gambar_kursus'] = $nama_foto;

            $data['background'] = $request->file('gambar_kursus');
            $nama_back = rand(1, 999) . "-" . $data['background']->getClientOriginalName();
            $data['background'] = Image::make($data['background']->getRealPath());
            $data['background']->save(public_path('assets/images/background-kursus/' . $nama_back));
            $data['background'] = $nama_back;
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
