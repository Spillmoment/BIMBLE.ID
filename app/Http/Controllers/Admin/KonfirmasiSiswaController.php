<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
                    return $item->siswa->nama_siswa ?? '';
                })
                ->addColumn('unit', function ($item) {
                    return $item->kursus_unit->unit->nama_unit ?? '';
                })
                ->addColumn('kursus', function ($item) {
                    return $item->kursus_unit->kursus->nama_kursus ?? '';
                })
                ->editColumn('foto', function ($item) {
                    return '<img src="' . url('storage/siswa/' . $item->siswa->foto) . '" style="max-height: 40px;"/>';
                })
                ->editColumn('file', function ($item) {
                    return view('admin.siswa_konfirmasi.modal', ['item' => $item]);
                })
                ->rawColumns(['action', 'foto', 'file'])
                ->make();
        }

        return view('admin.siswa_konfirmasi.index');
    }

    public function detail($id)
    {
    }

    public function confirm(Request $request)
    {
    }

    public function cancel(Request $request)
    {
    }
}
