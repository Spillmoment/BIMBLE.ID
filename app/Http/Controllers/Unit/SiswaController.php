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
        $list_siswa = SiswaKursus::with(['siswa','kursus_unit'])
                                ->whereHas('kursus_unit', function ($q) {
                                    $q->where('unit_id', Auth::id())
                                    ->where('type_id', 2);
                                })
                                ->where(function($q) {
                                    $q->where('status_sertifikat', 'terima')
                                      ->orWhere('status_sertifikat', 'lulus')
                                      ->orWhere('status_sertifikat', 'sertifikat');
                                  })
                                ->get();

        return view('unit.siswa.index_kelompok', [
            'list_siswa' => $list_siswa,
        ]);
    }
    
    public function card_kelompok($id)
    {
        $list_siswa = SiswaKursus::with(['siswa','kursus_unit'])
                                ->whereHas('kursus_unit', function ($q) {
                                    $q->where('unit_id', Auth::id())
                                    ->where('type_id', 2);
                                })
                                ->where('id', $id)
                                ->where(function($q) {
                                    $q->where('status_sertifikat', 'terima')
                                      ->orWhere('status_sertifikat', 'lulus')
                                      ->orWhere('status_sertifikat', 'sertifikat');
                                  })
                                ->get();
        $kursus_siswa = SiswaKursus::find($id);
        $siswa = Siswa::find($kursus_siswa->siswa_id);

        return view('unit.siswa.card_kelompok', [
            'list_siswa' => $list_siswa,
            'siswa' => $siswa
        ]);
    }
    
    public function edit_card_kelompok(Request $request, $id)
    {
        $cek_data = SiswaKursus::find($id);
        if ($cek_data) {
            $request->validate([
                'nilai'             => 'required|numeric|between:0,100',
                'status_sertifikat' => 'required|in:terima,lulus'
            ]);

            $data = $request->all();
            $cek_data->update($data);
            return redirect()->route('unit.siswa.kelompok.card', $id)->with([
                'status' => 'Data Siswa Berhasil Di Update'
            ]);
        } else {
            // abort(500, 'Terjadi kesalahan request.');
            return response()->json(['message' => 'Terjadi kesalahan requesting.'], 404);
        }
    }
    
    public function index_private()
    {
        $list_siswa = SiswaKursus::with(['siswa','kursus_unit'])
                                ->whereHas('kursus_unit', function ($q) {
                                    $q->where('unit_id', Auth::id())
                                    ->where('type_id', 1);
                                })
                                ->where(function($q) {
                                    $q->where('status_sertifikat', 'terima')
                                      ->orWhere('status_sertifikat', 'lulus')
                                      ->orWhere('status_sertifikat', 'sertifikat');
                                  })
                                ->get();

        return view('unit.siswa.index_private', [
            'list_siswa' => $list_siswa,
        ]);
    }

    public function card_private($id)
    {
        $list_siswa = SiswaKursus::with(['siswa','kursus_unit'])
                                ->whereHas('kursus_unit', function ($q) {
                                    $q->where('unit_id', Auth::id())
                                    ->where('type_id', 1);
                                })
                                ->where('id', $id)
                                ->where(function($q) {
                                    $q->where('status_sertifikat', 'terima')
                                      ->orWhere('status_sertifikat', 'lulus')
                                      ->orWhere('status_sertifikat', 'sertifikat');
                                  })
                                ->get();
        $kursus_siswa = SiswaKursus::find($id);
        $siswa = Siswa::find($kursus_siswa->siswa_id);

        return view('unit.siswa.card_private', [
            'list_siswa' => $list_siswa,
            'siswa' => $siswa
        ]);
    }
    
    public function edit_card_private(Request $request, $id)
    {
        $cek_data = SiswaKursus::find($id);
        if ($cek_data) {
            $request->validate([
                'nilai'             => 'required|numeric|between:0,100',
                'status_sertifikat' => 'required|in:terima,lulus'
            ]);

            $data = $request->all();
            $cek_data->update($data);
            return redirect()->route('unit.siswa.private.card', $id)->with([
                'status' => 'Data Siswa Berhasil Di Update'
            ]);
        } else {
            // abort(500, 'Terjadi kesalahan request.');
            return response()->json(['message' => 'Terjadi kesalahan requesting.'], 404);
        }
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
