<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UnitDaftarReq;
use App\Unit;
use App\Kursus;
use App\KursusUnit;
use Illuminate\Support\Facades\Storage;
use App\Galeri;
use App\GaleriKursus;
use Illuminate\Support\Str;

class UnitController extends Controller
{

    public function list(Request $request)
    {
        $unit = Unit::latest()->paginate(9);

        if ($request->keyword) {
            $unit = Unit::where('nama_unit', 'like', '%' . $request->keyword . '%')
                ->latest()->paginate(9);
        }

        return view('web.web_daftar_unit', [
            'unit' => $unit
        ]);
    }

    public function index()
    {
        return view('web.web_unit', ['kursus' => Kursus::all()]);
    }

    public function post(UnitDaftarReq $request)
    {
        $data = $request->all();

        // $file = $data['bukti_alumni'];
        // $file_name = 'Pendaftar Unit-' . $data['nama_unit'] . '.' . $file->getClientOriginalExtension();
        // $data['bukti_alumni'] =  $file->storeAs('public/uploads/bukti', $file_name);
        $data['slug'] = Str::slug($data['nama_unit'], '-');
        $data['bukti_alumni'] =  $request->file('bukti_alumni')->store('bukti', 'public');
        $data['status'] = '0';

        Unit::create($data);
        return redirect()->back()->with(['message' => 'Pendaftaran Unit Berhasil Dikirim']);
    }

    public function show($slug)
    {
        $unit = Unit::with(['kursus_unit', 'mentor', 'fasilitas'])
            ->where('slug', $slug)
            ->firstOrFail();

        $galeri = Galeri::with('unit')
            ->where('unit_id', $unit->id)
            ->latest()
            ->get();

        $kursus_unit = KursusUnit::with(['kursus', 'unit'])
            ->where('unit_id', $unit->id)
            ->get();

        // dd($kursus_check);

        return view('web.web_unit_kursus', [
            'unit' => $unit,
            'kursus_unit' => $kursus_unit,
            'galeri' => $galeri
        ]);
    }

    public function show_kursus($slug, $slug_kursus)
    {
        $unit = Unit::with(['kursus_unit', 'mentor', 'fasilitas'])
            ->where('slug', $slug)
            ->firstOrFail();

        $kursus = Kursus::where('slug', $slug_kursus)->firstOrFail();

        $kursus_unit = KursusUnit::with(['kursus', 'unit'])
            ->where('kursus_id', $kursus->id)
            ->where('unit_id', $unit->id)
            ->first();

        $kursus_lainya = KursusUnit::with(['kursus', 'unit'])
            ->where('unit_id', $unit->id)
            ->get();

        $gallery = GaleriKursus::with('kursus')
            ->where('kursus_id', $kursus->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(9);

        // dd($kursus_unit);

        return view('web.web_unit_kursus_detail', [
            'unit' => $unit,
            'kursus_unit' => $kursus_unit,
            'kursus_lainya' => $kursus_lainya,
            'gallery' => $gallery
        ]);
    }
}
