<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Komentar;

class KomentarController extends Controller
{

    public function index()
    {
        return view('admin.komentar.index', [
            'komentar' => Komentar::with('kursus_unit')->latest()->get()
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Komentar $komentar)
    {
        $komentar->delete();
        return redirect()->route('komentar.index')->with([
            'status' => 'Data Komentar Berhasil Dihapus!'
        ]);
    }
}
