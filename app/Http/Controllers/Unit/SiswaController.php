<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use App\Kursus;
use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $list_kursus = Kursus::with(['kursus_unit' => function ($q) {
            $q->where('unit_id', Auth::id());
        }])->get();
        // dd($list_kursus);

        return view('unit.siswa.index', [
            'list_kursus' => $list_kursus,
        ]);
    }

    public function kursus_siswa(Request $request, $slug)
    {
        $id_unit = Auth::id();
        $kursus = Kursus::where('slug', $slug)->first();
        $siswa = Siswa::where('kursus_id', $kursus->id)->where('unit_id', $id_unit)->get();

        return view('unit.siswa.siswa', [
            'kursus' => $kursus,
            'siswa' => $siswa,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_siswa($slug)
    {
        $kursus = Kursus::where('slug', $slug)->first();
        return view('unit.siswa.siswa_create', [
            'kursus' => $kursus,
            // 'siswa' => $siswa,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_siswa(Request $request, $slug)
    {
        $kursus = Kursus::where('slug', $slug)->first();
        $request->validate([
            'nama_siswa'    => 'required|max:255|min:3',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat'        => 'required|max:255|min:3',
            'nilai'         => 'required|numeric|between:0,100',
        ]);

        $data = $request->all();
        $data['kursus_id'] = $kursus->id;
        $data['unit_id'] = Auth::id();

        Siswa::create($data);
        return redirect()->route('unit.siswa.kursus', $kursus->slug)
            ->with(['status' => 'Data Siswa Berhasil Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug, $id)
    {
        // dd($slug);
        $siswa = Siswa::findOrFail($id);
        $kursus = Kursus::where('slug', $slug)->first();
        return view('unit.siswa.siswa_edit', compact('siswa','kursus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug, $id)
    {
        $request->validate([
            'nama_siswa'    => 'required|max:255|min:3',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat'        => 'required|max:255|min:3',
            'nilai'         => 'required|numeric|between:0,100',
        ]);

        $siswa = Siswa::findOrFail($id);
        $data = $request->all();

        $siswa->update($data);
        return redirect()->route('unit.siswa.kursus', $slug)->with([
            'status' => 'Data Siswa Berhasil Di Update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->forceDelete();
        return redirect()->back()->with('status', 'Data Siswa Berhasil Dihapus');
    }
}
