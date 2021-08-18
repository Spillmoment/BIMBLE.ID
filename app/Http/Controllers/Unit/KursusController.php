<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use App\Jadwal;
use App\Kursus;
use App\KursusUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KursusController extends Controller
{

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
        // KursusUnit::createMany([
        //     'kursus_id' => $request->kursus_id,
        //     'unit_id'  => $id_unit,
        //     'type_id' => 1,
        //     'biaya_kursus' => 0,
        //     'status' => 'nonaktif'
        // ],[
        //     'kursus_id' => $request->kursus_id,
        //     'unit_id'  => $id_unit,
        //     'type_id' => 2,
        //     'biaya_kursus' => 0,
        //     'status' => 'nonaktif'
        // ]);
        KursusUnit::insert(array(
            array('kursus_id' => $request->kursus_id,'unit_id'  => $id_unit,'type_id' => 1,'biaya_kursus' => 0,'status' => 'nonaktif'),
            array('kursus_id' => $request->kursus_id,'unit_id'  => $id_unit,'type_id' => 2,'biaya_kursus' => 0,'status' => 'nonaktif'),
            ));

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


    public function tambah_detail(Request $request, $id)
    {
        // $kursus = Kursus::where('slug', $slug)->first();
        $kursus_unit = KursusUnit::with(['kursus', 'unit'])
            ->where('id', $id)
            ->where('unit_id', Auth::id())
            ->first();
        
        $jadwal = Jadwal::with(['Kursus_unit'])
                    ->where('kursus_unit_id', $kursus_unit->id)
                    ->first();
        
        return view('unit.kursus.tambah', [
            // 'kursus' => $kursus,
            'kursus_unit' => $kursus_unit,
            'jadwal' => $jadwal,
        ]);
        
        
    }

    public function detail_store(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'biaya_kursus' => 'required|numeric|min:0',
            'hari' => 'numeric|min:1|max:7',
        ]);

        // checklistbox 
        if ($request->status == 'on') {
            $status = 'aktif';
        } else {
            $status = 'nonaktif';
        }
        

        $kursus = KursusUnit::findOrFail($id);
        $kursus->update([
            'biaya_kursus' => $request->biaya_kursus,
            'status' => $status
        ]);

        if ($request->hari || $request->waktu_mulai || $request->waktu_selesai) {
            Jadwal::updateOrCreate(
                ['kursus_unit_id' => $id],
                [
                    'hari' => $request->hari,
                    'waktu_mulai' => $request->waktu_mulai,
                    'waktu_selesai' => $request->waktu_selesai
                ]
            );
        }

        return redirect()->back()->with(['status' => 'Detail Kursus Berhasil Diupdate']);
    }
}
