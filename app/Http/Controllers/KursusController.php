<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kursus;
use App\Http\Requests\KursusRequest;
use App\Kategori;
use App\Gallery;
use App\Tutor;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KursusController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        // $kategori = Kategori::orderBy('created_at', 'DESC')->paginate(10);

        // $keyword = $request->get('keyword');
        // $filter_kategori = $request->get('nama_kategori');

        // if ($keyword) {
        //     $kursus = Kursus::with(['kategori', 'tutor'])
        //         ->where('nama_kursus', 'LIKE', "%$keyword%")
        //         ->paginate(10);
        // } else {
        //     $kursus = Kursus::orderBy('created_at', 'DESC')->paginate(10);
        // }

        // if ($filter_kategori) {
        //     $kursus = Kursus::with(['kategori', 'tutor'])
        //         ->where('id_kategori', 'LIKE', "%$filter_kategori%")
        //         ->orderBy('created_at', 'DESC')
        //         ->paginate(10);
        // }

        $kursus = Kursus::with('kategori')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('admin.kursus.index', compact('kursus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Kategori $kategori, Tutor $tutor)
    {
        return view('admin.kursus.create', [
            'kategori' => $kategori->all(),
            'tutor'    => $tutor->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KursusRequest $request)
    {
        $kursus = $request->all();
        $nama_kursus = $kursus['nama_kursus'];

        $kursus['slug'] = Str::slug($nama_kursus, '-');
        $kursus['gambar_kursus'] = $request->file('gambar_kursus')->store('kursus', 'public');

        Kursus::create($kursus);
        return redirect()->route('kursus.index')
            ->with(['status' => 'Data Kursus Berhasil Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Kursus $kursus)
    {
        return view('admin.kursus.show', compact('kursus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kursus $kursus, Kategori $kategori, Tutor $tutor)
    {
        return view('admin.kursus.edit', [
            'kursus'   => $kursus,
            'tutor'    => $tutor->all(),
            'kategori' => $kategori->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(KursusRequest $request, Kursus $kursus)
    {
        $data = $request->all();
        $nama_kursus = $data['nama_kursus'];
        $data['slug'] = Str::slug($nama_kursus, '-');

        if ($request->hasFile('gambar_kursus')) {
            if ($kursus->gambar_kursus && file_exists(storage_path('app/public/' . $kursus->gambar_kursus))) {
                Storage::delete('public/' . $kursus->gambar_kursus);
                $data['gambar_kursus'] = $request->file('gambar_kursus')->store('kursus', 'public');
            }
        }

        $kursus->update($data);
        return redirect()->route('kursus.index')->with(['status' => 'Data Kursus Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kursus $kursus)
    {
        File::delete('uploads/kursus/' . $kursus->gambar_kursus);
        $kursus->delete();
        return redirect()->route('kursus.index')
            ->with(['status' => 'Data Kursus Berhasil Dihapus']);
    }

    public function gallery($id)
    {
        $kursus = Kursus::with('galleries')
            ->findorFail($id);

        $gallery = Gallery::with('kursus')
            ->where('kursus_id', $id)
            ->orderBy('created_at', 'DESC')
            ->paginate(9);

        return view('admin.kursus.gallery')->with([
            'kursus' => $kursus,
            'items' => $gallery
        ]);
    }

    public function trash(Request $request)
    {
        $filter_trash = $request->get('trash');

        if ($filter_trash) {
            $kursus = Kursus::onlyTrashed()->where('nama_kursus', 'LIKE', "%$filter_trash%")
                ->paginate(10);
        } else {
            $kursus = Kursus::onlyTrashed()->paginate(10);
        }

        return view('admin.kursus.trash', compact('kursus'));
    }

    public function restore($id)
    {
        $kursus = Kursus::withTrashed()->findOrFail($id);

        if ($kursus->trashed()) {
            $kursus->restore();
        } else {
            return redirect()->route('kursus.index')
                ->with(['status' => 'kursus tidak ada di Trash']);
        }
        return redirect()->route('kursus.index')
            ->with(['status' => 'kursus Sukses Dikembalikan']);
    }

    public function deletePermanent($id)
    {
        $kursus = Kursus::withTrashed()->findOrFail($id);
        if (!$kursus->trashed()) {
            return redirect()->route('kursus.trash')
                ->with('status', 'Tidak bisa menghapus permanent data kursus yang aktif');
        } else {
            $kursus->forceDelete();
            return redirect()->route('kursus.trash')
                ->with('status', 'Data kursus berhasil dihapus permanent');
        }
    }
}
