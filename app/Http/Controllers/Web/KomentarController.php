<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\KursusUnit;
use App\Komentar;
use App\Unit;
use App\Http\Requests\KomentarRequest;

class KomentarController extends Controller
{

    public function post(KomentarRequest $request, $id)
    {
        $kursus_unit = KursusUnit::where('id', $id)
            ->first()->id;

        $komentar = $request->all();
        $komentar['kursus_unit_id'] = $kursus_unit;

        Komentar::create($komentar);

        return redirect()->back()->with(['message' => 'Review berhasil dikirim']);
    }
}
