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
            ->groupBy('kursus_id')->paginate(6);
        // dd($kursus_unit);

        return view('unit.kursus.index', [
            'list_kursus' => $list_kursus,
            'kursus_unit' => $kursus_unit
        ]);
    }

    public function tambah_kursus(Request $request)
    {
        $id_unit = Auth::id();
        KursusUnit::insert(array(
            array('kursus_id' => $request->kursus_id, 'unit_id'  => $id_unit, 'type_id' => 1, 'biaya_kursus' => 0, 'status' => 'nonaktif'),
            array('kursus_id' => $request->kursus_id, 'unit_id'  => $id_unit, 'type_id' => 2, 'biaya_kursus' => 0, 'status' => 'nonaktif'),
        ));

        $kursus = Kursus::find($request->kursus_id);
        return response()->json([
            'message' => 'Bimbel ' . $kursus->nama_kursus . ' berhasil ditambahkan.'
        ]);
    }

    public function hapus_kursus(Request $request)
    {
        $id_unit = Auth::id();
        KursusUnit::where('kursus_id', $request->kursus_id)
            ->where('unit_id', $id_unit)->forceDelete();

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


    public function tambah_detail($id)
    {
        // $kursus = Kursus::where('slug', $slug)->first();
        $kursus_unit_kelompok = KursusUnit::with(['kursus', 'unit'])
            ->where('kursus_id', $id)
            ->where('unit_id', Auth::id())
            ->where('type_id', 2)
            ->first();

        $kursus_unit_private = KursusUnit::with(['kursus', 'unit'])
            ->where('kursus_id', $id)
            ->where('unit_id', Auth::id())
            ->where('type_id', 1)
            ->first();

        $senin = Jadwal::with(['kursus_unit'])->where('kursus_unit_id', $kursus_unit_kelompok->id)
            ->where('hari', 1)
            ->first();
        $selasa = Jadwal::with(['kursus_unit'])->where('kursus_unit_id', $kursus_unit_kelompok->id)
            ->where('hari', 2)
            ->first();
        $rabu = Jadwal::with(['kursus_unit'])->where('kursus_unit_id', $kursus_unit_kelompok->id)
            ->where('hari', 3)
            ->first();
        $kamis = Jadwal::with(['kursus_unit'])->where('kursus_unit_id', $kursus_unit_kelompok->id)
            ->where('hari', 4)
            ->first();
        $jumat = Jadwal::with(['kursus_unit'])->where('kursus_unit_id', $kursus_unit_kelompok->id)
            ->where('hari', 5)
            ->first();
        $sabtu = Jadwal::with(['kursus_unit'])->where('kursus_unit_id', $kursus_unit_kelompok->id)
            ->where('hari', 6)
            ->first();
        $minggu = Jadwal::with(['kursus_unit'])->where('kursus_unit_id', $kursus_unit_kelompok->id)
            ->where('hari', 7)
            ->first();

        return view('unit.kursus.tambah', [
            // 'kursus' => $kursus,
            'kursus_unit_kelompok' => $kursus_unit_kelompok,
            'kursus_unit_private' => $kursus_unit_private,
            'senin' => $senin,
            'selasa' => $selasa,
            'rabu' => $rabu,
            'kamis' => $kamis,
            'jumat' => $jumat,
            'sabtu' => $sabtu,
            'minggu' => $minggu,
        ]);
    }

    public function update_harga(Request $request, $id)
    {
        $request->validate([
            'biaya_kursus' => 'required|numeric|min:0',
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

        return redirect()->back()->with(['status' => 'Detail Kursus Berhasil Diupdate']);
    }

    public function detail_store(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'hari' => 'numeric|min:1|max:7',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
        ]);

        Jadwal::updateOrCreate(
            ['kursus_unit_id' => $id, 'hari' => $request->hari],
            [
                'hari' => $request->hari,
                'waktu_mulai' => $request->waktu_mulai,
                'waktu_selesai' => $request->waktu_selesai
            ]
        );

        return redirect()->back()->with(['status' => 'Detail Kursus Berhasil Diupdate']);
    }
}
