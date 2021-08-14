<?php

namespace App\Http\Controllers\Unit;

use App\Fasilitas;
use App\Http\Controllers\Controller;
use App\Kursus;
use App\KursusUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FasilitasController extends Controller
{


    public function index()
    {
        $fasilitas_unit = Fasilitas::where('unit_id', Auth::id())->get()->pluck('item');
        $fasilitas_unit_array = $fasilitas_unit->all();
        // dd($fasilitas_unit_array);
        return view('unit.fasilitas.index', [
            'fasilitas_unit' => $fasilitas_unit_array
        ]);
    }

    public function tambah_fasilitas(Request $request)
    {
        $id_unit = Auth::id();
        Fasilitas::create([
            'unit_id' => $id_unit,
            'item'  => $request->item,
        ]);

        return response()->json([
            'message' => 'Item ' . $request->item . ' berhasil ditambahkan.'
        ]);
    }

    public function hapus_fasilitas(Request $request)
    {
        $id_unit = Auth::id();
        $fasilitas_unit = Fasilitas::where('unit_id', $id_unit)->where('item', $request->item)->first();
        $fasilitas_unit->forceDelete();

        return response()->json([
            'message' => 'Item ' . $request->item . ' berhasil dihapus.'
        ]);
    }


    public function create()
    {
        // 
    }


    public function store(Request $request)
    {
        // 
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
        //
    }
}
