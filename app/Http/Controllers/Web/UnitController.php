<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UnitDaftarReq;
use App\Unit;
use App\Kursus;
use App\KursusUnit;
use App\Galeri;
use App\GaleriKursus;
use App\Jadwal;
use App\Materi;
use App\MentorKursus;
use App\SiswaKursus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UnitController extends Controller
{

    public function list(Request $request)
    {
        $unit = Unit::where('status', '1')->latest()->paginate(9);
        if ($request->keyword) {
            $unit = Unit::where('nama_unit', 'like', '%' . $request->keyword . '%')
                ->where('status', '1')
                ->latest()->paginate(9);
        }

        if ($request->place) {
            $unit = Unit::where('alamat', 'like', '%' . $request->place . '%')
                ->where('status', '1')
                ->latest()->paginate(9);
        }

        return view('web.web_daftar_unit', [
            'unit' => $unit
        ]);
    }

    public function getAutocomplete(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = Unit::select('id', 'alamat')->where('alamat', 'LIKE', '%' . $cari . '%')->get();
            return response()->json($data);
        }
    }


    public function index()
    {
        return view('web.web_unit', ['kursus' => Kursus::limit(6)->get()]);
    }

    public function post(UnitDaftarReq $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($data['nama_unit'], '-');

        if ($file = $request->file('bukti_alumni')) {
            $name = $file->getClientOriginalName();
            $file->move('storage/file', $name);
        }

        $data['bukti_alumni'] = $name;
        $data['status'] = '2';

        Unit::create($data);
        return back()->with(['message' => 'Pendaftaran Unit Berhasil Dikirim']);
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

        $kursus_kelompok = KursusUnit::with(['kursus', 'unit'])
            ->whereNotNull('type_id')
            ->where('type_id', 2)
            ->where('unit_id', $unit->id)
            ->where('status', 'aktif')
            ->get();

        $kursus_private = KursusUnit::with(['kursus', 'unit'])
            ->whereNotNull('type_id')
            ->where('type_id', 1)
            ->where('unit_id', $unit->id)
            ->where('status', 'aktif')
            ->get();


        return view('web.web_unit_kursus', [
            'unit' => $unit,
            'kursus_kelompok' => $kursus_kelompok,
            'kursus_private' => $kursus_private,
            'galeri' => $galeri
        ]);
    }

    public function show_kursus($slug, $slug_kursus, Request $request)
    {
        $type_kursus = $request->query('type');

        $unit = Unit::with(['kursus_unit', 'mentor', 'fasilitas'])
            ->where('slug', $slug)
            ->firstOrFail();

        $kursus = Kursus::where('slug', $slug_kursus)
            ->firstOrFail();

        $kursus_unit = KursusUnit::with(['kursus', 'unit'])
            ->where('kursus_id', $kursus->id)
            ->where('unit_id', $unit->id)
            ->where('type_id', $type_kursus)
            ->first();

        $jadwal = Jadwal::where('kursus_unit_id', $kursus_unit->id)->get();

        $check_kursus = SiswaKursus::where('siswa_id', Auth::id())
            ->where('kursus_unit_id', $kursus_unit->id)
            ->where('status_sertifikat', 'daftar')
            ->first();

        $check_file =  SiswaKursus::where('siswa_id', Auth::id())->first();

        $materi = Materi::where('kursus_id', $kursus->id)
            ->where('unit_id', $unit->id)
            ->orderBy('bab', 'ASC')->get();

        $mentor_kursus = MentorKursus::query()->with(['kursus_unit', 'mentor'])
            ->where('kursus_unit_id', $kursus_unit->id)
            ->get()
            ->map(function ($item) {
                return $item->mentor;
            });

        // dd($mentor_kursus);
        return view('web.web_unit_kursus_detail', [
            'unit' => $unit,
            'kursus_unit' => $kursus_unit,
            'jadwals' => $jadwal,
            'check_kursus' => $check_kursus,
            'check_file' => $check_file,
            'materis' => $materi,
            'mentor' => $mentor_kursus,
        ]);
    }
}
