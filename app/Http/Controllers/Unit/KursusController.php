<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use App\Kursus;
use App\KursusUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KursusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $id_unit = Auth::id();
        $list_kursus = Kursus::with(['kursus_unit' => function ($q) {
            $q->where('unit_id', Auth::id());
        }])->get();
        // dd($list_kursus);

        return view('unit.kursus.index', [
            'list_kursus' => $list_kursus,
        ]);
    }

    public function tambah_kursus(Request $request)
    {
        $id_unit = Auth::id();
        $tambah = KursusUnit::create([
            'kursus_id' => $request->kursus_id,
            'unit_id'  => $id_unit,
            'biaya_kursus' => 0
        ]);

        $kursus = Kursus::find($request->kursus_id);

        return response()->json([
            'message' => 'Bimbel ' . $kursus->nama_kursus . ' berhasil ditambahkan.'
        ]);
    }

    public function hapus_kursus(Request $request)
    {
        $id_unit = Auth::id();
        $kursus_unit = KursusUnit::where('kursus_id', $request->kursus_id)->where('unit_id', $id_unit)->first();
        $kursus_unit->forceDelete();

        $kursus = Kursus::find($request->kursus_id);

        return response()->json([
            'message' => 'Bimbel ' . $kursus->nama_kursus . ' berhasil dihapus.'
        ]);
    }

    public function harga_kursus(Request $request)
    {
        $request->validate([
            'biaya_kursus' => 'required|numeric|min:0'
        ]);

        KursusUnit::where('id', $request->id)
            ->update([
                'biaya_kursus' => $request->biaya_kursus,
            ]);

        return redirect()->back()->with(['success' => 'Ok, harga berhasil diubah.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tutor.nilai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
