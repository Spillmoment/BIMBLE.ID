<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use App\Kursus;
use App\KursusUnit;
use App\Siswa;
use App\SiswaKursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{


    public function index_kelompok()
    {
        $list_kursus = KursusUnit::with('kursus')->where('unit_id', Auth::id())->where('type_id', 2)->get();

        return view('unit.siswa.index_kelompok', [
            'list_kursus' => $list_kursus,
        ]);
    }
    
    public function index_private()
    {
        $list_kursus = KursusUnit::with('kursus')->where('unit_id', Auth::id())->where('type_id', 1)->get();

        return view('unit.siswa.index_private', [
            'list_kursus' => $list_kursus,
        ]);
    }

    public function kursus_siswa($id)
    {
        $siswa = Siswa::where('kursus_unit_id', $id)->get();
        $kursus = KursusUnit::with(['kursus','type'])->where('id', $id)->first();

        return view('unit.siswa.siswa', [
            'kursus_unit_id' => $id,
            'kursus' => $kursus,
            'siswa' => $siswa,
        ]);
    }

    public function create_siswa($id)
    {
        $kursus = KursusUnit::with(['kursus'])->where('id', $id)->first();

        return view('unit.siswa.siswa_create', [
            'kursus' => $kursus,
        ]);
    }

    public function store_siswa(Request $request, $id)
    {
        // $kursus = Kursus::where('slug', $slug)->first();
        $request->validate([
            'nama_siswa'    => 'required|max:255|min:3',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat'        => 'required|max:255|min:3',
            'nilai'         => 'required|numeric|between:0,100',
            'sertifikat'    => 'nullable|max:10000|mimes:pdf'
        ]);

        $data = $request->all();

        if ($file = $request->file('sertifikat')) {
            $extension = $file->getClientOriginalExtension();
            $fileName = time(). "." .$extension;
            $file->move('storage/sertifikat', $fileName);
            $data['sertifikat'] = $fileName;
        }

        $data['kursus_unit_id'] = $id;

        Siswa::create($data);
        return redirect()->route('unit.siswa.kursus', $id)->with(['status' => 'Data Siswa Berhasil Ditambahkan']);
    }

    public function edit($id, $id_siswa)
    {
        $siswa = Siswa::findOrFail($id_siswa);
        // $kursus = Kursus::where('slug', $slug)->first();
        return view('unit.siswa.siswa_edit', compact('siswa', 'id'));
    }

    public function update(Request $request, $id, $id_siswa)
    {
        $request->validate([
            'nama_siswa'    => 'required|max:255|min:3',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat'        => 'required|max:255|min:3',
            'nilai'         => 'required|numeric|between:0,100',
            'sertifikat'    => 'nullable|max:10000|mimes:pdf'
        ]);

        $siswa = Siswa::findOrFail($id_siswa);
        $data = $request->all();

        if ($file = $request->file('sertifikat')) {
            Storage::delete('public/sertifikat/' . $siswa->sertifikat);
            $extension = $file->getClientOriginalExtension();
            $fileName = time(). "." .$extension;
            $file->move('storage/sertifikat', $fileName);
            $data['sertifikat'] = $fileName;
        }

        $siswa->update($data);
        return redirect()->route('unit.siswa.kursus', $id)->with([
            'status' => 'Data Siswa Berhasil Di Update'
        ]);
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        Storage::delete('public/sertifikat/' . $siswa->sertifikat);
        $siswa->forceDelete();
        return redirect()->back()->with('status', 'Data Siswa Berhasil Dihapus');
    }

    public function konfirmasi_siswa()
    {
        $semua_siswa = SiswaKursus::with(['siswa','kursus_unit'])
                                    ->whereHas('kursus_unit', function ($q) {
                                        $q->where('unit_id', Auth::id());
                                    })
                                    ->where('status_sertifikat', 'daftar')
                                    ->get();
        // dd($semua_siswa);
        return view('unit.siswa.konfirmasi', compact('semua_siswa'));
    }
    
    public function update_konfirmasi(Request $request)
    {
        $cek_data = SiswaKursus::find($request->siswa);
        if ($cek_data) {
            SiswaKursus::where('id', $request->siswa)
                        ->update([
                            'status_sertifikat' => 'terima'
                        ]);
    
            return response()->json([
                'message' => 'Siswa berhasil diterima.'
            ]);
        } else {
            // abort(500, 'Terjadi kesalahan request.');
            return response()->json(['message' => 'Terjadi kesalahan requesting.'], 404);
        }
                
    }
}
