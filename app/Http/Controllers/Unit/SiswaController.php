<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use App\Kursus;
use App\KursusUnit;
use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{


    public function index()
    {
        // $list_kursus = Kursus::with(['kursus_unit' => function ($q) {
        //     $q->where('unit_id', Auth::id());
        // }], 'kursus_unit')->get();
        // dd($list_kursus);
        $list_kursus = KursusUnit::with((['kursus']))->where('unit_id', Auth::id())->get();

        return view('unit.siswa.index', [
            'list_kursus' => $list_kursus,
        ]);
    }

    public function kursus_siswa(Request $request, $id)
    {
        $id_unit = Auth::id();
        // $kursus = Kursus::where('slug', $slug)->first();
        $siswa = Siswa::where('kursus_unit_id', $id)->get();

        return view('unit.siswa.siswa', [
            'kursus_unit_id' => $id,
            'siswa' => $siswa,
        ]);
    }


    public function create_siswa($id)
    {
        // $kursus = Kursus::where('slug', $slug)->first();
        $kursus = KursusUnit::with(['kursus'])->where('id', $id)->first();

        return view('unit.siswa.siswa_create', [
            'kursus' => $kursus,
            // 'siswa' => $siswa,
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
        ]);

        $data = $request->all();
        $data['kursus_unit_id'] = $id;

        Siswa::create($data);
        return redirect()->route('unit.siswa.kursus', $id)->with(['status' => 'Data Siswa Berhasil Ditambahkan']);
    }


    public function edit($id, $id_siswa)
    {
        $siswa = Siswa::findOrFail($id_siswa);
        // $kursus = Kursus::where('slug', $slug)->first();
        return view('unit.siswa.siswa_edit', compact('siswa','id'));
    }


    public function update(Request $request, $id, $id_siswa)
    {
        $request->validate([
            'nama_siswa'    => 'required|max:255|min:3',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat'        => 'required|max:255|min:3',
            'nilai'         => 'required|numeric|between:0,100',
        ]);

        $siswa = Siswa::findOrFail($id_siswa);
        $data = $request->all();

        $siswa->update($data);
        return redirect()->route('unit.siswa.kursus', $id)->with([
            'status' => 'Data Siswa Berhasil Di Update'
        ]);
    }


    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->forceDelete();
        return redirect()->back()->with('status', 'Data Siswa Berhasil Dihapus');
    }
}
