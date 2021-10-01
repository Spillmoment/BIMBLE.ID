<?php

namespace App\Http\Controllers\Unit;

use App\Galeri;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class GaleriController extends Controller
{

    public function index()
    {

        if (request()->ajax()) {
            $query = Galeri::where('unit_id', Auth::id())
                ->latest()->get();

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
                                    <div class="dropdown-menu" aria-labelledby="action' .  $item->siswa_id . '">
                                        <a class="text-info dropdown-item" href="' . route('unit.siswa.kelompok.card', $item->siswa_id) . '"><span
                                        class="fas fa-eye mr-2"></span>Detail</a>  
                                    </div>
                                </div>';
                })
                ->addColumn('nama_siswa', function ($item) {
                    return $item->siswa->nama_siswa;
                })
                ->addColumn('kursus', function ($item) {
                    return $item->kursus_unit->kursus->nama_kursus;
                })
                ->rawColumns(['status_sertifikat', 'action'])
                ->make();
        }


        return view('unit.galeri.index');
    }


    public function create()
    {
        // 
    }


    public function store(Request $request)
    {
        $request->validate([
            'gambar.*' => 'required|image|mimes:jpg,jpeg,png,bmp,gif,svg'
        ]);

        $images = array();

        if ($files = $request->file('gambar')) {
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $file->move('storage/galeri', $name);
                $images[] = $name;
            }
        }

        Galeri::insert([
            'unit_id' => Auth::id(),
            'gambar' => implode("|", $images)
        ]);

        return redirect()->route('unit.galeri.home')
            ->with(['status' => 'File Berhasil Disimpan']);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
    }


    public function update(Request $request, $id)
    {
    }


    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        File::delete('/storage/galeri/' . $galeri->foto);
        $galeri->delete();
        return redirect()->route('unit.galeri.home')->with('status', 'Data Galeri Berhasil Dihapus');
    }
}
