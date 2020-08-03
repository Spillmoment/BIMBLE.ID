<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pendaftar;

class PendaftarController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pendaftar = Pendaftar::orderBy('created_at', 'DESC')->paginate(10);

        $filterKeyword = $request->get('keyword');
        $status = $request->get('status');

        if ($status) {
            $pendaftar = Pendaftar::where('status', $status)
                ->paginate(10);
        } else {
            $pendaftar = Pendaftar::orderBy('created_at', 'DESC')->paginate(10);
        }

        if ($filterKeyword) {
            if ($status) {
                $pendaftar = Pendaftar::where('nama_pendaftar', 'LIKE', "%$filterKeyword%")
                    ->where('status', $status)
                    ->paginate(10);
            } else {
                $pendaftar = Pendaftar::where('nama_pendaftar', 'LIKE', "%$filterKeyword%")
                    ->paginate(10);
            }
        }

        return view('admin.pendaftar.index', ['pendaftar' => $pendaftar]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        return view('admin.pendaftar.show', ['pendaftar' => $pendaftar]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Pendaftar::findOrfail($id);
        $user->delete();
        return redirect()->route('pendaftar.index')
            ->with(['status' => 'Data pendaftar berhasil dihapus']);
    }
}
