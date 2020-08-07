<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Kursus;
use Illuminate\Http\Request;
use App\Nilai;
use App\OrderDetail;
use App\Pendaftar;
use App\Siswa;
use App\Tutor;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $id_tutor = Auth::id();
        $nilai = Nilai::with(['pendaftar', 'tutor', 'kursus'])
            ->where('id_tutor', $id_tutor)
            ->orderBy('created_at', 'DESC')
            ->paginate(12);
        return view('tutor.nilai.list', [
            'nilai' => $nilai
        ]);
    }

    public function tutor_kursus()
    {
        $id_tutor = Auth::id();
        $tutor = Tutor::where('id', $id_tutor)->pluck('nama_tutor');
        $list_kursus = Kursus::where('id_tutor', $id_tutor)->get();

        return view('tutor.nilai.index', [
            'tutor' => $tutor,
            'kursus_tutor' => $list_kursus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tutor.nilai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nilai' => 'required|numeric|between:0,100',
            'keterangan' => 'required'
        ]);

        $cek_data = Nilai::where('id_kursus', $request->idKursus)
            ->where('id_pendaftar', $request->idPendaftar)
            ->first();

        if ($cek_data == null) {
            $nilai = new Nilai();
            $nilai->id_tutor = Auth::id();
            $nilai->id_kursus = $request->idKursus;
            $nilai->id_pendaftar = $request->idPendaftar;
            $nilai->nilai = $request->nilai;
            $nilai->keterangan = $request->keterangan;
            $nilai->save();
            return redirect()->back()->with(['success' => 'Ok, data berhasil disimpan.']);
        } else {
            return redirect()->back()->with(['failed' => 'Maaf, Pendaftar ini sudah memiliki nilai.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nilai = Nilai::findOrFail($id);
        return view('tutor.nilai.edit_nilai_pendaftar', compact('nilai'));
    }

    public function edit_nilai_pendaftar(Request $request)
    {
        $request->validate([
            'nilai' => 'required|numeric|between:0,100',
            'keterangan' => 'required'
        ]);

        Nilai::where('id', $request->id)
            ->update([
                'nilai' => $request->nilai,
                'keterangan' => $request->keterangan
            ]);
        return redirect()->back()->with(['success' => 'Ok, data berhasil diubah.']);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        $siswa->nilai = $request->nilai;
        $siswa->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function kursus_nilai($slug)
    {
        $id_tutor = Auth::id();
        $kursus = Kursus::where('slug', $slug)->first();
        $siswa = Siswa::where('id_kursus', $kursus->id)->get();
        $order_detail = OrderDetail::with(['pendaftar', 'pendaftar.nilai'])
            ->where('id_kursus', $kursus->id)
            ->where('status', 'SUCCESS')
            ->get();
        // dd($order_detail);
        return view('tutor.nilai.kursus', compact('kursus', 'siswa', 'order_detail'));
    }
}
