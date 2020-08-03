<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Komentar;
use App\Kursus;
use App\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KursusUserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function kursus_success()
    {
        $users_id = Auth::id();
        $kursus_success = OrderDetail::with(['pendaftar', 'kursus', 'order'])
            ->where('id_pendaftar', $users_id)
            ->where(function ($query) {
                $query->where('status', 'SUCCESS');
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(6);

        $check = OrderDetail::with(['pendaftar', 'kursus', 'order'])
            ->where('id_pendaftar', $users_id)
            ->where(function ($query) {
                $query->where('status', 'SUCCESS');
            })->count();

        return view('web.web_kursus_success', [
            'kursus_success' => $kursus_success,
            'check' => $check
        ]);
    }

    public function kursusKelas($slug)
    {
        $kursus = Kursus::with('galleries')->where('slug', $slug)->first();
        $komentar = Komentar::with(['pendaftar', 'kursus'])
            ->where('id_kursus', $kursus->id)
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('web.web_kursus_user', compact('kursus', 'komentar'));
    }

    public function kursusKelasKomentar(Request $request, $slug)
    {
        $pendaftarId = Auth::id();
        $kursus = Kursus::where('slug', $slug)->first()->id;
        $request->validate([
            'textkomen'  => 'required',
        ], ['textkomen.required' => 'Isikan review anda.']);

        $komen = new Komentar();
        $komen->id_kursus = $kursus;
        $komen->id_pendaftar = $pendaftarId;
        $komen->isi_komentar = $request->textkomen;
        $komen->tanggal_komentar = date('Y-m-d');
        $komen->save();

        return redirect()->back()->with(['flash' => 'Review Berhasil dikirim']);
    }
}
