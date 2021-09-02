<?php

namespace App\Http\Controllers\Unit;

use App\Fasilitas;
use App\Galeri;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class GaleriController extends Controller
{


    public function index()
    {
        $galeri_unit = Galeri::where('unit_id', Auth::id())
            ->latest()->get();
        // dd($galeri_unit);
        return view('unit.galeri.index', [
            'galeri_unit' => $galeri_unit
        ]);
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
