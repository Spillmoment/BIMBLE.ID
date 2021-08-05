<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kursus;
use App\Type;
use Illuminate\Support\Facades\DB;
use App\Banner;
use App\KursusUnit;
use App\GaleriKursus;
use phpDocumentor\Reflection\Types\Null_;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $banner = Banner::all();
        $kursus_unit = KursusUnit::selectRaw('kursus_id')
            ->with('kursus')->groupBy('kursus_id')
            ->latest()->paginate(9);
        $type = Type::all();

        return view('web.web_home', compact('kursus_unit', 'banner', 'type'));
    }


    public function pusat_bantuan()
    {
        return view('web.web_pusat_bantuan');
    }


    public function kursus(Request $request)
    {
        $kursus = Kursus::latest()->paginate(9);
        $kursus_unit = KursusUnit::with('kursus', 'type')->groupBy('kursus_id')->paginate(9);
        $typeKursus = Type::all();

        $keyword = $request->query('keyword');
        $type = $request->query('type');
        $nama_type = '';

        if ($keyword) {
            $kursus_unit = KursusUnit::with('kursus')
                ->whereHas('kursus', function ($query) use ($keyword) {
                    $query->where('nama_kursus', 'LIKE', "%$keyword%");
                })
                ->groupBy('kursus_id')
                ->latest()
                ->paginate(9);
        }

        if ($type) {
            $kursus_unit = KursusUnit::with('type', 'kursus')
                ->where('type_id', $type)
                ->whereHas('kursus', function ($query) use ($keyword) {
                    $query->where('nama_kursus', 'LIKE', "%$keyword%");
                })
                ->groupBy('kursus_id')
                ->latest()
                ->paginate(9);

            $type = Type::findOrFail($type);
            $nama_type = $type->nama_type;
        }

        return view('web.web_kursus', compact('kursus_unit', 'typeKursus', 'nama_type'));
    }


    public function kursus_unit($id)
    {
        $kursus = Kursus::with('kursus_unit')->latest()->paginate(10);
        $active = KursusUnit::where('kursus_id', $id)->first();
        $kursus_unit = KursusUnit::with('kursus', 'unit')
            ->where('kursus_id', $id)
            ->latest()
            ->paginate(9);

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

    public function show_kelompok($slug, Request $request)
    {
        $kursus = Kursus::where('slug', $slug)
            ->firstOrFail();

        $kursus_unit = KursusUnit::where('kursus_id', $kursus->id)
            ->where('type_id', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        // ->groupBy('unit_id')

        $gallery = GaleriKursus::with('kursus')
            ->where('kursus_id', $kursus->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(9);

        $startday = $request->query('startday');
        $endday = $request->query('endday');
        $get_time = $request->query('clock');
        $clock = date('H:00:00', strtotime($get_time));

        if ($startday || $endday || $get_time) {
            $kursus_unit = KursusUnit::with('jadwal')
                ->whereHas('jadwal', function ($query) use ($startday, $endday, $clock, $get_time) {
                    if ($startday == 0 || $endday == 0) {
                        $query->whereTime('waktu_mulai', '=', $clock);
                    } elseif (empty($get_time)) {
                        if ($startday <= $endday) {
                            $query->whereBetween('hari', [$startday, $endday]);
                        } else {
                            $query->whereNotBetween('hari', [$endday + 1, $startday - 1]);
                        }
                    } else {
                        if ($startday <= $endday) {
                            $query->whereBetween('hari', [$startday, $endday])->whereTime('waktu_mulai', '=', $clock);
                        } else {
                            $query->whereNotBetween('hari', [$endday + 1, $startday - 1])->whereTime('waktu_mulai', '=', $clock);
                        }
                    }
                })
                ->where('kursus_id', $kursus->id)
                ->where('type_id', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(6);
            // dd('hello');
        }

        return view('web.web_detail_kursus_kelompok', [
            'kursus' => $kursus,
            'kursus_unit' => $kursus_unit,
            'gallery' => $gallery
        ]);
    }

    public function show_private($slug, Request $request)
    {
        $kursus = Kursus::where('slug', $slug)->firstOrFail();
        $kursus_unit = KursusUnit::where('kursus_id', $kursus->id)
            ->where('type_id', 2)
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        $gallery = GaleriKursus::with('kursus')
            ->where('kursus_id', $kursus->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(9);

        $startday = $request->query('startday');
        $endday = $request->query('endday');
        $clock = $request->query('jam');

        $day_array = array($startday, $endday);
        $max_number_day = max($day_array);
        $min_number_day = min($day_array);

        if ($startday || $endday) {
            $kursus_unit = KursusUnit::with('jadwal')
                ->whereHas('jadwal', function ($query) use ($min_number_day, $max_number_day, $clock) {
                    if (empty($clock)) {
                        $query->whereBetween('hari', [$min_number_day, $max_number_day]);
                    } else {
                        $query->whereBetween('hari', [$min_number_day, $max_number_day])
                            ->whereTime('waktu_mulai', '=', $clock);
                    }
                })
                ->where('kursus_id', $kursus->id)
                ->where('type_id', 2)
                ->orderBy('created_at', 'desc')
                ->paginate(6);
        }

        return view('web.web_detail_kursus_private', [
            'kursus' => $kursus,
            'kursus_unit' => $kursus_unit,
            'gallery' => $gallery
        ]);
    }
}
