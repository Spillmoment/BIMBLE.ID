<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kursus;
use App\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Unit;
use App\Banner;
use App\KursusUnit;
use App\Mentor;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $banner = Banner::all();
        $unit = Unit::where('status', '1')
            ->latest()->get();

        $keyword = $request->get('unit');
        if ($keyword) {
            $unit = Unit::where('nama_unit', 'like', "%$keyword%")
                ->orderBy('created_at', 'desc')->paginate(4);
        }

        return view('web.web_home', compact('unit', 'banner', 'null'));
    }


    public function pusat_bantuan()
    {
        return view('web.web_pusat_bantuan');
    }

    public function kursus(Request $request)
    {
        $kursus = Kursus::with('kursus_unit')->orderBy('created_at', 'DESC')->paginate(10);
        $keyword = $request->get('keyword');

        $kursus_unit = KursusUnit::with('kursus')->latest()->first();

        if ($keyword) {
            $kursus = Kursus::where('nama_kursus', 'LIKE', "%$keyword%")
                ->orWhere('keterangan', 'LIKE', "%$keyword%")
                ->orderBy('created_at', 'DESC')
                ->paginate(9);
        }

        return view('web.web_kursus', compact('kursus', 'kursus_unit'));
    }

    public function kursus_unit($id)
    {
        $kursus = Kursus::with('kursus_unit')->latest()->paginate(10);
        $active = KursusUnit::where('kursus_id', $id)->first();
        $kursus_unit = KursusUnit::with('kursus', 'unit')
            ->where('kursus_id', $id)->latest()->paginate(9);

        return view('web.web_kursus_unit', compact('kursus_unit', 'kursus', 'active'));
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
        $kursus_unit = KursusUnit::where('kursus_id', $kursus->id)
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        // dd($kursus_unit);
        return view('web.web_detail_kursus', [
            'kursus' => $kursus,
            'kursus_unit' => $kursus_unit
        ]);
    }
}
