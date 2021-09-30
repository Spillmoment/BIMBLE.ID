<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use App\Jadwal;
use App\Kursus;
use App\KursusUnit;
use App\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

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
        $kursus = Kursus::find($id);
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

        $materi = Materi::where('kursus_id', $id)->where('unit_id', Auth::id())->get();

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
            'kursus' => $kursus,
            'materi' => $materi,
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

    public function create_materi(Request $request, $kursus_id)
    {
        $request->validate([
            'bab' => 'required|numeric|between:1,10',
            'judul' => 'required',
            'konten' => 'required',
            'file' => 'required|max:2000|mimes:pdf',
        ]);

        $cek_bab = Materi::where('kursus_id', $kursus_id)->where('unit_id', Auth::id())->where('bab', $request->bab)->first();

        if ($cek_bab) {
            return redirect()->back()->withErrors(['message' => 'Bab telah ada.']);
        } else {
            $extention = $request->file('file')->extension();
            $filename = Auth::id() . '-' . date('dmyHis') . '.' . $extention;
            Storage::putFileAs('public/materi', $request->file('file'), $filename);

            Materi::create([
                'kursus_id' => $kursus_id,
                'unit_id' => Auth::id(),
                'bab' => $request->bab,
                'judul' => $request->judul,
                'konten' => $request->konten,
                'file' => $filename
            ]);

            return redirect()->back()->with(['status' => 'Materi Berhasil Ditambah.']);
        }
    }

    public function delete_materi($materi_id)
    {
        $materi = Materi::findOrFail($materi_id);
        unlink(storage_path('app/public/materi/' . $materi->file));
        $materi->delete();
        return redirect()->back()->with(['status' => 'Materi Berhasil Dihapus.']);
    }

    public function download_materi($filename)
    {
        $filepath = storage_path() . '/' . 'app' . '/public/materi/' . $filename;
        return Response::download($filepath);
    }
}
