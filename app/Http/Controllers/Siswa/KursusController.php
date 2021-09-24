<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\KursusUnit;
use App\Materi;
use App\SiswaKursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KursusController extends Controller
{
    public function pesan_kursus(Request $request, $kursus_unit_id)
    {
        if (KursusUnit::where('id', $kursus_unit_id)->exists()) {

            SiswaKursus::create([
                'siswa_id' => Auth::id(),
                'kursus_unit_id' => $kursus_unit_id,
                'status_sertifikat' => 'daftar'
            ]);
            return back()->withInput();

        }else{
            return back()->withInput();
        }
    }

    public function kursus()
    {
        $kursus_terima = SiswaKursus::with(['kursus_unit.kursus:id,nama_kursus', 'kursus_unit.unit:id,nama_unit'])
                        ->where('siswa_id', Auth::id())
                        ->where(function($q) {
                            $q->where('status_sertifikat', 'terima')
                              ->orWhere('status_sertifikat', 'lulus')
                              ->orWhere('status_sertifikat', 'sertifikat');
                          })
                        ->get();

        $kursus_proses = SiswaKursus::with(['kursus_unit.kursus:id,nama_kursus', 'kursus_unit.unit:id,nama_unit'])
                        ->where('siswa_id', Auth::id())
                        ->where('status_sertifikat', 'daftar')
                        ->get();

        // dd($kursus_terima);
        return view('web.web_profile', compact('kursus_proses','kursus_terima'));
    }

    public function materi($kursus_unit_id)
    {
        $cek_siswa = SiswaKursus::where('siswa_id', Auth::id())
                        ->where('kursus_unit_id', $kursus_unit_id)
                        ->where('status_sertifikat', 'daftar')
                        ->first();
                        
        if ($cek_siswa) {
            return back()->withInput();
        } else {
            $materi = Materi::with(['kursus_unit.kursus:id,nama_kursus', 'kursus_unit.unit:id,nama_unit'])
                        ->where('kursus_unit_id', $kursus_unit_id)->get();
    
            $owner = KursusUnit::with(['kursus:id,nama_kursus', 'unit:id,nama_unit'])->where('id',$kursus_unit_id)->first();
            // dd($owner);
            return view('web.web_profile', compact('materi','owner'));
        }
        

    }

}
