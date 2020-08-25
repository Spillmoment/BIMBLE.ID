<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kursus;
use App\Type;
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
        $kursus = Kursus::with('type')->where('status', 'aktif')->latest()->get();
        $type = Type::all();

        if ($request->keyword) {
            $kursus = Kursus::where('nama_kursus', 'like', "%" . $request->keyword . "%")
                ->where('status', 'aktif')
                ->latest()->paginate(4);
        }

        return view('web.web_home', compact('kursus', 'banner', 'type'));
    }


    public function pusat_bantuan()
    {
        return view('web.web_pusat_bantuan');
    }


    public function kursus(Request $request)
    {
        $kursus = Kursus::where('status', 'aktif')->latest()->paginate(9);
        $keyword = $request->query('keyword');
        $type = $request->query('type');
        $nama_type = '';

        if ($keyword) {
            $kursus = Kursus::where('nama_kursus', 'like', "%$keyword%")
                ->where('status', 'aktif')
                ->latest()->paginate(9);
        }

        if ($type) {
            $kursus = Kursus::with('type')
                ->where('id_type', $type)
                ->where('nama_kursus', 'like', "%$keyword%")
                ->latest()
                ->paginate(4);

            $type = Type::findOrFail($type);
            $nama_type = $type->nama_type;
        }

        return view('web.web_kursus', compact('kursus', 'nama_type'));
    }


    public function kursus_unit($id)
    {
        $kursus = Kursus::with('kursus_unit')->latest()->paginate(10);
        $active = KursusUnit::where('kursus_id', $id)->first();
        $kursus_unit = KursusUnit::with('kursus', 'unit')
            ->where('kursus_id', $id)
            ->latest()->paginate(9);

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
