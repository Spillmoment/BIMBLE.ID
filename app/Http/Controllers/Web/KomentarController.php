<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\KursusUnit;
use App\Komentar;
use App\Http\Requests\KomentarRequest;

class KomentarController extends Controller
{

    public function post(KomentarRequest $request, $id)
    {
        Komentar::create([
            'nama' => auth()->user()->nama_siswa,
            'email' => auth()->user()->email,
            'kursus_unit_id' =>  KursusUnit::where('id', $id)->first()->id,
            'komentar' => $request->komentar
        ]);

        return back()->with(['message' => 'Review berhasil dikirim']);
    }
}
