<?php

namespace App\Http\Controllers\Unit;

use App\Fasilitas;
use App\Galeri;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $galeri_unit = Galeri::where('unit_id', Auth::id())
            ->latest()->get();
        // dd($galeri_unit);
        return view('unit.galeri.index', [
            'galeri_unit' => $galeri_unit
        ]);
    }

    // public function hapus_fasilitas(Request $request)
    // {
    //     $id_unit = Auth::id();
    //     $fasilitas_unit = Fasilitas::where('unit_id', $id_unit)->where('item', $request->item)->first();
    //     $fasilitas_unit->forceDelete();

    //     return response()->json([
    //         'message' => 'Item ' . $request->item . ' berhasil dihapus.'
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'gambar.*' => 'required|image|mimes:jpg,jpeg,png,bmp'
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        Storage::delete('public/' . $galeri->foto);
        $galeri->delete();
        return redirect()->route('unit.galeri.home')->with('status', 'Data Galeri Berhasil Dihapus');
    }
}
