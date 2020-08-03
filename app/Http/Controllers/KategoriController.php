<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use App\Http\Requests\KategoriRequest;
use App\Repositories\KategoriRepositoryInterface;

class KategoriController extends Controller
{
    private $model;
    public function __construct(KategoriRepositoryInterface $model)
    {
        $this->model = $model;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $kategori = $this->model->getAll();

        $filterKeyword = $request->get('keyword');

        if ($filterKeyword) {
            $kategori = Kategori::where('nama_kategori', 'LIKE', "%$filterKeyword%")
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        }

        return view('admin.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KategoriRequest $request)
    {
        $this->model->create($request->all());
        return redirect()->route('kategori.index')
            ->with(['status' => 'Data Kategori Berhasil Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KategoriRequest $request, $id)
    {
        $this->model->update($id, $request->all());
        return redirect()->route('kategori.index')
            ->with(['status' => 'Data Kategori Berhasil Diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model->delete($id);
        return redirect()->route('kategori.index')
            ->with(['status'  => 'Data Kategori Berhasil Dihapus']);
    }
}
