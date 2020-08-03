<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kursus;
use App\Kategori;
use App\OrderDetail;
use App\Komentar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $idPendaftar = Auth::id();
        $kursus = Kursus::with(['kategori', 'tutor',])
            ->withCount('order_detail')
            ->orderBy('created_at', 'DESC')
            ->get();
        $kategori = Kategori::all();

        $keyword = $request->get('keyword');
        if ($keyword) {
            $kursus = Kursus::where('nama_kursus', 'like', "%$keyword%")
                ->withCount('order_detail')
                ->orderBy('created_at', 'desc')->paginate(4);
        }

        $filter_kategori = $request->get('kategori');
        $nama_kategori = '';
        if ($filter_kategori) {
            $kursus = Kursus::with('kategori')
                ->where('id_kategori', $filter_kategori)
                ->withCount('order_detail')
                ->orderBy('created_at', 'DESC')
                ->paginate(4);

            $data_kategori = Kategori::findOrFail($filter_kategori);
            $nama_kategori = $data_kategori->nama_kategori;
        }

        $status_kursus = OrderDetail::with('kursus', 'pendaftar')
            ->where('id_pendaftar', $idPendaftar)
            ->where('status', 'SUCCESS')
            ->get();
        // dd($status_kursus);

        return view('web.web_home', compact('kursus', 'kategori', 'nama_kategori', 'status_kursus'));
    }

    public function pusat_bantuan()
    {
        return view('web.web_pusat_bantuan');
    }


    public function kursus(Request $request)
    {
        $kursus = Kursus::with(['kategori', 'tutor'])
            ->withCount('order_detail')
            ->orderBy('created_at', 'DESC')->paginate(9);
        $kategori = Kategori::latest()->get();

        $keyword = $request->get('keyword');
        $filter_kategori = $request->get('kategori');

        if ($keyword) {
            $kursus = Kursus::with(['kategori', 'tutor'])
                ->where('nama_kursus', 'LIKE', "%$keyword%")
                ->withCount('order_detail')
                ->orderBy('created_at', 'DESC')
                ->paginate(9);
        }

        $nama_kategori = '';
        if ($filter_kategori) {
            $kursus = Kursus::with('kategori')
                ->where('id_kategori', 'LIKE', "%$filter_kategori%")
                ->withCount('order_detail')
                ->orderBy('created_at', 'DESC')
                ->paginate(9);

            $data_kategori = Kategori::findOrFail($filter_kategori);
            $nama_kategori = $data_kategori->nama_kategori;
        }

        return view('web.web_kursus', compact('kursus', 'kategori', 'nama_kategori'));
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
        $pendaftarId = Auth::id();

        $kursus = Kursus::with(['galleries'])
            ->where('slug', $slug)->firstOrFail();

        $kategori = Kategori::latest()->get();

        $review = Komentar::with('kursus')
            ->where('id_kursus', $kursus->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $check_kursus_status = OrderDetail::where('id_pendaftar', $pendaftarId)
            ->where('id_kursus', $kursus->id)
            ->where(function ($query) {
                $query->where('status', 'PROCESS')
                    ->orWhere('status', 'CANCEL')
                    ->orWhere('status', 'PENDING')
                    ->orWhere('status', 'FAILED');
            })
            ->first();

        $check_kursus_sukses = OrderDetail::where('id_pendaftar', $pendaftarId)
            ->where('id_kursus', $kursus->id)
            ->where('status', 'SUCCESS')
            ->first();

        return view('web.web_detail_kursus', [
            'kursus' => $kursus,
            'kategori' => $kategori,
            'check_kursus' => $check_kursus_status,
            'check_kursus_sukses' => $check_kursus_sukses,
            'review' => $review
        ]);
    }

    public function review($slug)
    {
        $kursus = Kursus::where('slug', $slug)->firstOrFail();
        $komentar = Komentar::with(['pendaftar', 'kursus'])
            ->where('id_kursus', $kursus->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(6);
        $no_kursus = Komentar::with('kursus')
            ->first();

        $krs_lainya = Kursus::with(['komentar'])
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('web.web_review_kursus', [
            'kursus'   => $kursus,
            'komentar' => $komentar,
            'komen'   => $no_kursus,
            'lain'     => $krs_lainya,
        ]);
    }
}
