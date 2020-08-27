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
        $list_kursus = Kursus::with(['kursus_unit' => function ($q) {
            $q->where('unit_id', Auth::id());
        }])->get();

        $kursus_unit = KursusUnit::with(['kursus', 'unit'])
            ->where('unit_id', Auth::id())
            ->latest()->get();
        // dd($kursus_unit);

        return view('unit.kursus.index', [
            'list_kursus' => $list_kursus,
            'kursus_unit' => $kursus_unit
        ]);
    }

    public function tambah_kursus(Request $request)
    {
        $id_unit = Auth::id();
        KursusUnit::create([
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
        $kursus_unit = KursusUnit::where('kursus_id', $request->kursus_id)
            ->where('unit_id', $id_unit)->first();
        $kursus_unit->forceDelete();

        $kursus = Kursus::find($request->kursus_id);

        return response()->json([
            'message' => 'Bimbel ' . $kursus->nama_kursus . ' berhasil dihapus.'
        ]);
    }

    public function detail($slug)
    {
        $kursus = Kursus::where('slug', $slug)->first();
        $kursus_unit = KursusUnit::with(['kursus', 'unit'])
            ->where('kursus_id', $kursus->id)
            ->where('unit_id', Auth::id())
            ->first();

        return view('unit.kursus.detail', [
            'kursus' => $kursus,
            'kursus_unit' => $kursus_unit
        ]);
    }


    public function tambah_detail(Request $request, $slug)
    {
        $kursus = Kursus::where('slug', $slug)->first();
        $kursus_unit = KursusUnit::with(['kursus', 'unit'])
            ->where('kursus_id', $kursus->id)
            ->where('unit_id', Auth::id())
            ->first();

        return view('unit.kursus.tambah', [
            'kursus' => $kursus,
            'kursus_unit' => $kursus_unit
        ]);
    }

    public function detail_store(Request $request, $id)
    {
        $request->validate([
            'biaya_kursus' => 'required|numeric|min:0'
        ]);

        $kursus = KursusUnit::findOrFail($id);
        $kursus->update([
            'biaya_kursus' => $request->biaya_kursus,
        ]);

        return redirect()->back()->with(['status' => 'Detail Kursus Berhasil Diupdate']);
    }
}
