<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use App\Siswa;
use App\SiswaKursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SiswaController extends Controller
{

    public function index_kelompok()
    {

        if (request()->ajax()) {
            $query = SiswaKursus::with(['siswa', 'kursus_unit'])
                ->whereHas('kursus_unit', function ($q) {
                    $q->where('unit_id', Auth::id())
                        ->where('type_id', 2);
                })
                ->where(function ($q) {
                    $q->where('status_sertifikat', 'terima')
                        ->orWhere('status_sertifikat', 'lulus')
                        ->orWhere('status_sertifikat', 'sertifikat');
                })
                ->groupBy('siswa_id')
                ->latest()
                ->get();

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
                                <div class="dropdown-menu" aria-labelledby="action' .  $item->siswa_id . '">
                                    <a class="text-info dropdown-item" href="' . route('unit.siswa.kelompok.card', $item->siswa_id) . '"><span
                                    class="fas fa-eye mr-2"></span>Detail</a>  
                                </div>
                            </div>';
                })
                ->addColumn('nama_siswa', function ($item) {
                    return $item->siswa->nama_siswa;
                })
                ->addColumn('kursus', function ($item) {
                    return $item->kursus_unit->kursus->nama_kursus;
                })
                ->editColumn('status', function ($item) {
                    switch ($item->status_sertifikat) {
                        case 'terima':
                            return '<span class="btn btn-primary btn-sm">Siswa</span>';
                            break;
                        case 'lulus':
                            return '<span class="btn btn-info btn-sm">Lulus</span>';
                            break;
                        default:
                            return ' <button class="btn btn-success btn-sm"><i class="fas fa-download"></i> Lulus</button>';
                            break;
                    }
                })
                ->rawColumns(['status_sertifikat', 'action'])
                ->make();
        }

        return view('unit.siswa.index_kelompok');
    }

    public function card_kelompok($id)
    {
        $list_siswa = SiswaKursus::with(['siswa', 'kursus_unit'])
            ->whereHas('kursus_unit', function ($q) {
                $q->where('unit_id', Auth::id())
                    ->where('type_id', 2);
            })
            ->where('siswa_id', $id)
            ->where(function ($q) {
                $q->where('status_sertifikat', 'terima')
                    ->orWhere('status_sertifikat', 'lulus')
                    ->orWhere('status_sertifikat', 'sertifikat');
            })
            ->latest()
            ->paginate(9);
        $siswa = Siswa::find($id);

        return view('unit.siswa.card_kelompok', [
            'list_siswa' => $list_siswa,
            'siswa' => $siswa
        ]);
    }

    public function edit_card_kelompok(Request $request, $id)
    {
        $cek_data = SiswaKursus::find($id);
        if ($cek_data) {
            $request->validate([
                'nilai'             => 'required|numeric|between:0,100',
                'status_sertifikat' => 'required|in:terima,lulus'
            ]);

            $data = $request->all();
            $cek_data->update($data);
            return redirect()->route('unit.siswa.kelompok.card', $cek_data->siswa_id)->with([
                'status' => 'Data Siswa Berhasil Di Update',
            ]);
        } else {
            return response()->json(['message' => 'Terjadi kesalahan requesting.'], 404);
        }
    }

    public function index_private()
    {
        if (request()->ajax()) {
            $query = SiswaKursus::with(['siswa', 'kursus_unit'])
                ->whereHas('kursus_unit', function ($q) {
                    $q->where('unit_id', Auth::id())
                        ->where('type_id', 1);
                })
                ->where(function ($q) {
                    $q->where('status_sertifikat', 'terima')
                        ->orWhere('status_sertifikat', 'lulus')
                        ->orWhere('status_sertifikat', 'sertifikat');
                })
                ->latest()
                ->get();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return
                        '<a class="text-info dropdown-item" href="' . route('unit.siswa.private.card', $item->siswa_id) . '"><span
                                    class="fas fa-eye mr-2"></span>Detail</a>  
                                ';
                })
                ->addColumn('nama_siswa', function ($item) {
                    return $item->siswa->nama_siswa;
                })
                ->addColumn('kursus', function ($item) {
                    return $item->kursus_unit->kursus->nama_kursus;
                })
                ->editColumn('status_sertifikat', function ($item) {
                    switch ($item->status_sertifikat) {
                        case 'terima':
                            return '<span class="btn btn-primary btn-sm">Siswa</span>';
                            break;
                        case 'lulus':
                            return '<span class="btn btn-info btn-sm">Lulus</span>';
                            break;
                        default:
                            return ' <button class="btn btn-success btn-sm"><i class="fas fa-download"></i> Lulus</button>';
                            break;
                    }
                })
                ->rawColumns(['status_sertifikat', 'action'])
                ->make();
        }

        return view('unit.siswa.index_private');
    }

    public function card_private($id)
    {
        $list_siswa = SiswaKursus::with(['siswa', 'kursus_unit'])
            ->whereHas('kursus_unit', function ($q) {
                $q->where('unit_id', Auth::id())
                    ->where('type_id', 1);
            })
            ->where('siswa_id', $id)
            ->where(function ($q) {
                $q->where('status_sertifikat', 'terima')
                    ->orWhere('status_sertifikat', 'lulus')
                    ->orWhere('status_sertifikat', 'sertifikat');
            })
            ->latest()
            ->paginate(9);

        $siswa = Siswa::find($id);

        return view('unit.siswa.card_private', [
            'list_siswa' => $list_siswa,
            'siswa' => $siswa
        ]);
    }

    public function edit_card_private(Request $request, $id)
    {
        $cek_data = SiswaKursus::find($id);
        if ($cek_data) {
            $request->validate([
                'nilai'             => 'required|numeric|between:0,100',
                'status_sertifikat' => 'required|in:terima,lulus'
            ]);

            $data = $request->all();
            $cek_data->update($data);
            return redirect()->route('unit.siswa.private.card', $cek_data->siswa_id)->with([
                'status' => 'Data Siswa Berhasil Di Update'
            ]);
        } else {
            // abort(500, 'Terjadi kesalahan request.');
            return response()->json(['message' => 'Terjadi kesalahan requesting.'], 404);
        }
    }
}
