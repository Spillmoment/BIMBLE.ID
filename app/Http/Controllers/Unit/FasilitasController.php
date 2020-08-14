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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
            'message' => 'Item '.$request->item.' berhasil ditambahkan.'
        ]);
    }
    
    public function hapus_fasilitas(Request $request)
    {
        $id_unit = Auth::id();
        $fasilitas_unit = Fasilitas::where('unit_id',$id_unit)->where('item',$request->item)->first();
        $fasilitas_unit->forceDelete();

        return response()->json([
            'message' => 'Item '.$request->item.' berhasil dihapus.'
        ]);
    }

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
        // 
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
        //
    }
}
