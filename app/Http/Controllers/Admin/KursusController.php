<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Kursus\KursusExports;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kursus;
use App\Http\Requests\KursusRequest;
use Illuminate\Support\Str;
use App\GaleriKursus;
use App\Http\Traits\KursusImageTraits;
use App\Kategori;
use App\SiswaKursus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class KursusController extends Controller
{
    use KursusImageTraits;
    public function index(Request $request)
    {
        $kategori = Kategori::latest()->get();

        if (request()->ajax()) {

            if ($request->input('kategori') != 0) {
                $query = Kursus::where('kategori_id', $request->kategori);
            } else {
                $query = Kursus::query()->with(['kategori'])->latest();
            }

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
                    return $item->kategori->nama_kategori ?? '';
                })
                ->editColumn('gambar_kursus', function ($item) {
                    return '<img src="' . url('assets/images/kursus/' . $item->gambar_kursus) . '" style="max-height: 40px;"/>';
                })
                ->rawColumns(['action', 'gambar_kursus'])
                ->make();
        }

        return view(
            'admin.kursus.index',
            [
                'kategori' => $kategori,
            ]
        );
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

        $data['gambar_kursus'] = $this->uploadImage($request, 'gambar_kursus');
        $data['background'] = $this->uploadImage($request, 'background');

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

            $data['gambar_kursus'] = $this->uploadImage($request, 'gambar_kursus');
            $data['background'] = $this->uploadImage($request, 'background');
        }

        $kursus->update($data);
        return redirect()->route('kursus.index')
            ->with(['status' => 'Data Kursus Berhasil Di Update']);
    }


    public function destroy($id)
    {
        $kursus = Kursus::findOrFail($id);
        File::delete(public_path('assets/images/kursus/' . $kursus->gambar_kursus));
        File::delete(public_path('assets/images/background-kursus/' . $kursus->background));
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

    public function export_excel()
    {
        $tgl = now();
        return Excel::download(new KursusExports, 'Laporan-Kursus-' . $tgl . '.xlsx');
    }

    public function export_pdf()
    {
        $tgl = now();
        $kursus = Kursus::latest()->get();
        $pdf = PDF::loadview('admin.kursus.pdf', ['kursus' => $kursus]);
        return $pdf->download('laporan-kursus-' . $tgl . '.pdf');
    }
}
