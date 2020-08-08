<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kursus;
use App\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Unit;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $idPendaftar = Auth::id();
        $kursus = Kursus::orderBy('created_at', 'DESC')
            ->get();

        $keyword = $request->get('keyword');
        if ($keyword) {
            $kursus = Kursus::where('nama_kursus', 'like', "%$keyword%")
                ->orderBy('created_at', 'desc')->paginate(4);
        }

        return view('web.web_home', compact('kursus'));
    }

    public function pusat_bantuan()
    {
        return view('web.web_pusat_bantuan');
    }


    public function kursus(Request $request)
    {
        $kursus = Kursus::orderBy('created_at', 'DESC')->paginate(9);

        $keyword = $request->get('keyword');


        if ($keyword) {
            $kursus = Kursus::with(['kategori', 'tutor'])
                ->where('nama_kursus', 'LIKE', "%$keyword%")
                ->withCount('order_detail')
                ->orderBy('created_at', 'DESC')
                ->paginate(9);
        }


        return view('web.web_kursus', compact('kursus'));
    }

    public function kursusSort(Request $request)
    {
        $sort = $request->sorted;

        if ($sort == 'termurah') {
            $data =  Kursus::select(DB::raw('*, biaya_kursus - ((diskon_kursus/100)*biaya_kursus) as urut'))
                ->orderBy('urut', 'asc')
                ->paginate(9);
        } else {
            $data =  Kursus::select(DB::raw('*, biaya_kursus - ((diskon_kursus/100)*biaya_kursus) as urut'))
                ->orderBy('urut', 'desc')
                ->paginate(9);
        }

        return view('web.ajax.web_kursus_card_sorted', ['kursus' => $data]);
    }

    public function show($slug)
    {
        $kursus = Kursus::where('slug', $slug)->firstOrFail();
        $unit = Unit::latest()->paginate(6);
        return view('web.web_detail_kursus', [
            'kursus' => $kursus,
            'unit'   => $unit
        ]);
    }

    // public function review($slug)
    // {
    //     $kursus = Kursus::where('slug', $slug)->firstOrFail();

    //     $komentar = Komentar::with(['pendaftar', 'kursus'])
    //         ->where('id_kursus', $kursus->id)
    //         ->orderBy('created_at', 'DESC')
    //         ->paginate(6);

    //     $no_kursus = Komentar::with('kursus')
    //         ->first();

    //     $krs_lainya = Kursus::with(['komentar'])
    //         ->orderBy('created_at', 'DESC')
    //         ->get();

    //     return view('web.web_review_kursus', [
    //         'kursus'   => $kursus,
    //         'komentar' => $komentar,
    //         'komen'   => $no_kursus,
    //         'lain'     => $krs_lainya,
    //     ]);
    // }
}
