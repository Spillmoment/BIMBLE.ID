<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\KursusUnit;
use App\Materi;
use App\SiswaKursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

class KursusController extends Controller
{
    public function pesan_kursus($kursus_unit_id)
    {
        if (KursusUnit::where('id', $kursus_unit_id)->exists()) {

            SiswaKursus::create([
                'siswa_id' => Auth::id(),
                'kursus_unit_id' => $kursus_unit_id,
                'status_sertifikat' => 'daftar'
            ]);
            return back()->withInput();
        } else {
            return back()->withInput();
        }
    }

    public function kursus()
    {
        $kursus_terima = SiswaKursus::with(['kursus_unit.kursus:id,nama_kursus', 'kursus_unit.unit:id,nama_unit'])
            ->where('siswa_id', Auth::id())
            ->where(function ($q) {
                $q->where('status_sertifikat', 'terima')
                    ->orWhere('status_sertifikat', 'lulus')
                    ->orWhere('status_sertifikat', 'sertifikat');
            })
            ->get();

        $kursus_proses = SiswaKursus::with(['kursus_unit.kursus:id,nama_kursus', 'kursus_unit.unit:id,nama_unit'])
            ->where('siswa_id', Auth::id())
            ->where('status_sertifikat', 'daftar')
            ->get();

        return view('web.web_profile', compact('kursus_proses', 'kursus_terima'));
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
            $kursus_unit = KursusUnit::find($kursus_unit_id);
            $materi = Materi::with(['kursus:id,nama_kursus', 'unit:id,nama_unit'])
                ->where('kursus_id', $kursus_unit->kursus->id)
                ->where('unit_id', $kursus_unit->unit->id)
                ->get();

            $owner = KursusUnit::with(['kursus:id,nama_kursus', 'unit:id,nama_unit'])->where('id', $kursus_unit_id)->first();

            return view('web.web_profile', compact('materi', 'owner'));
        }
    }

    public function sertifikat_index()
    {
        $kursus_lulus = SiswaKursus::with(['kursus_unit.kursus:id,nama_kursus', 'kursus_unit.unit:id,nama_unit'])
            ->where('siswa_id', Auth::id())
            ->where(function ($q) {
                $q->where('status_sertifikat', 'lulus')
                    ->orWhere('status_sertifikat', 'sertifikat');
            })
            ->get();

        return view('web.web_profile', compact('kursus_lulus'));
    }

    public function sertifikat_update(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|max:2000|image|mimes:jpg,jpeg,png',
        ]);

        $cek_data = SiswaKursus::find($id);

        if ($cek_data->file == null) {
            $upload = $request->file('file');
            $fileName = date('dmyHis') . "-" . $upload->getClientOriginalName();
            $uploads = Image::make($upload->getRealPath());
            $uploads->save(public_path('assets/images/bukti-siswa/' . $fileName));
            $uploads = $fileName;

            $cek_data->update([
                'file' => $uploads,
                'invalid_message' => null
            ]);
            return redirect()->back()
                ->with(['status' => 'Bukti Pembayaran Berhasil Di Upload!']);
        } else {
            File::delete(public_path('assets/images/bukti-siswa/' . $cek_data->file));
            $upload = $request->file('file');
            $fileName = date('dmyHis') . "-" . $upload->getClientOriginalName();
            $uploads = Image::make($upload->getRealPath());
            $uploads->save(public_path('assets/images/bukti-siswa/' . $fileName));
            $uploads = $fileName;

            $cek_data->update([
                'file' => $uploads,
                'invalid_message' => null
            ]);

            return redirect()->back()
                ->with(['status' => 'Bukti Pembayaran Berhasil Di Update!']);
        }
    }
}
