<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Keuangan;
use App\RuleGaji;
use App\Siswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\SiswaKursus;

class KonfirmasiSiswaController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = SiswaKursus::with(['siswa', 'kursus_unit.kursus', 'kursus_unit.unit'])
                ->where(function ($q) {
                    $q->where('status_sertifikat', 'daftar');
                })
                ->groupBy('siswa_id', 'kursus_unit_id');

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return
                        '<div class="btn-group">
                            <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="icon icon-sm">
                                    <span class="fas fa-ellipsis-h icon-dark"></span>
                                </span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                <a class="dropdown-item" href="' . route('siswa-konfirmasi.detail', $item->id) . '"><span
                                        class="fas fa-eye mr-2"></span>Detail</a>
                                
                                <form action="' . route('siswa-konfirmasi.cancel', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button id="deleteButton" type="submit" class="dropdown-item text-danger" data-name="' . $item->siswa->nama_siswa .  '">
                                        <span class="fas fa-trash-alt mr-2"></span>Hapus</a>
                                    </button>
                                </form>
                            </div>
                        </div>';
                })
                ->addColumn('siswa', function ($item) {
                    return  '<a href="#">'.$item->siswa->nama_siswa.'</a>';
                })
                ->addColumn('unit', function ($item) {
                    return $item->kursus_unit->unit->nama_unit ?? '';
                })
                ->addColumn('kursus', function ($item) {
                    return $item->kursus_unit->kursus->nama_kursus ?? '';
                })
                ->editColumn('file', function ($item) {
                    return view('admin.siswa_konfirmasi.modal', ['item' => $item]);
                })
                ->rawColumns(['action', 'foto', 'file','siswa'])
                ->make();
        }

        return view('admin.siswa_konfirmasi.index');
    }

    public function detail($id)
    {
        $siswa_kursus = SiswaKursus::with(['siswa', 'kursus_unit'])->findOrFail($id);
        $rule_gaji = RuleGaji::latest()->first();
// dd($rule_gaji);
        return view('admin.siswa_konfirmasi.detail', ['data' => $siswa_kursus, 'rule_gaji' => $rule_gaji
    ]);
    }

    public function invalid_message(Request $request, $id)
    {
        // $request->validate([
        //     'invalid_message' => 'required',
        // ]);
        // dd($request->all());

        if (is_null($request->invalid_message)) {
            return redirect()->route('siswa-konfirmasi.invalid', $id)
            ->with('message_null', 'Anda belum memberikan pesan.');
        }

        $siswa_kursus = SiswaKursus::findOrFail($id);
        $siswa_kursus->update([
            'invalid_message' => $request->invalid_message,
        ]);
    
        return redirect()->route('siswa-konfirmasi.invalid', $id)
        ->with('invalid', 'Pesan berhasil terkirim');
    }

    public function confirm($id)
    {
        $siswa_kursus = SiswaKursus::findOrFail($id);
        if ($siswa_kursus->status_sertifikat == 'daftar') {
            $confirm = $siswa_kursus->update([
                'status_sertifikat' => 'terima', 
                'invalid_message' => null,
            ]);
        }

        if ($confirm) {
            $check_keuangan = Keuangan::with('rule_gaji')->where('unit_id', $siswa_kursus->kursus_unit->unit_id)
                                ->where('status', 'inactive')
                                ->whereMonth('created_at', date('m'))
                                ->whereYear('created_at', date('Y'))
                                ->first();
            $biaya_kursus = $siswa_kursus->kursus_unit->biaya_kursus;

            if ($check_keuangan) {
                $percentage = $check_keuangan->rule_gaji->unit;
                $count_pendapatan = intval(($percentage/100) * $biaya_kursus);
                $total_pendapatan = intval($check_keuangan->nominal) + $count_pendapatan;

                $check_keuangan->update([
                    'nominal' => $total_pendapatan
                ]);
            } else {
                $last_rule = RuleGaji::latest('created_at')->first();
                $percentage = $last_rule->unit;
                $count_pendapatan = intval(($percentage/100) * $biaya_kursus);

                $keuangan = New Keuangan();
                $keuangan->unit_id = $siswa_kursus->kursus_unit->unit_id;
                $keuangan->rule_gaji_id = $last_rule->id;
                $keuangan->nominal = $count_pendapatan;
                $keuangan->status = 'inactive';
                $keuangan->save();
            }
                        
            return redirect()->route('siswa-konfirmasi.index')
            ->with('status', 'Siswa berhasil terkonfirmasi.');
        }

    }

    public function cancel(Request $request)
    {
    }
    
    public function notification()
    {
        $check_pendaftaran = SiswaKursus::where('status_sertifikat', 'daftar')->whereNotNull('file')->count();
        return response()->json([
            'total_pendaftar' => $check_pendaftaran,
            'state' => 'CA',
        ]);
    }
}
