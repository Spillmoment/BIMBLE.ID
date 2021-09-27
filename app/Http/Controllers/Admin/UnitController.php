<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Unit;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
    public function index()
    {

        if (request()->ajax()) {
            $query = Unit::query()->where('status', '1')->latest();
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
                                <a class="dropdown-item" href="' . route('unit.show', $item->id) . '"><span
                                        class="fas fa-eye mr-2"></span>Detail</a>
                                <a class="dropdown-item" href="' . route('unit.edit', $item->id) . '"><span
                                        class="fas fa-edit mr-2"></span>Sunting</a>
                                <form action="' . route('unit.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button id="deleteButton" type="submit" class="dropdown-item text-danger" data-name="' . $item->nama_unit .  '">
                                        <span class="fas fa-trash-alt mr-2"></span>Hapus</a>
                                    </button>
                                </form>
                            </div>
                        </div>';
                })
                ->editColumn('gambar_unit', function ($item) {
                    if (!empty($item->gambar_unit)) {
                        return '<img src="' . url('assets/images/unit/' . $item->gambar_unit) . '" style="max-height: 40px;"/>';
                    } else {
                        return 'N/A';
                    }
                })
                ->rawColumns(['action', 'gambar_unit'])
                ->make();
        }

        return view('admin.unit.index');
    }

    public function create()
    {
        return view('admin.unit.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_unit'             => 'required|min:3|max:100',
            'deskripsi'             => 'required|min:10',
            'alamat'                => 'required|min:3|max:200',
            'email'                 => 'required|email|unique:unit',
            'whatsapp'              => 'required',
            'telegram'              => 'required',
            'instagram'             => 'required',
            'username'              => 'required|max:100|unique:unit',
            'password'              => 'required|min:3',
            'konfirmasi_password'   => 'required|same:password|min:3'
        ]);

        $data = $request->all();
        $nama_slug = $data['nama_unit'];
        $data['slug'] = Str::slug($nama_slug, '-');
        $data['password'] = Hash::make($data['password']);

        Unit::create($data);
        return redirect()->route('unit.index')
            ->with(['status' => 'Data Unit Berhasil Ditambahkan']);
    }


    public function show(Unit $unit)
    {
        return view('admin.unit.show', compact('unit'));
    }


    public function edit(Unit $unit)
    {
        return view('admin.unit.edit', compact('unit'));
    }


    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'nama_unit'             => 'required|min:3|max:100',
            'deskripsi'             => 'required|min:10',
            'alamat'                => 'required|min:3|max:200',
            'email'                 => 'required|email|unique:unit,email,' . $unit->id,
            'gambar_unit'           => 'sometimes|nullable|image|mimes:jpg,jpeg,png,bmp',
            'username'              => 'required|min:3|max:100|unique:unit,username,' . $unit->id,
            'whatsapp'              => 'required',
            'telegram'              => 'required',
            'instagram'             => 'required',
            'password'              => 'sometimes|nullable|min:3',
            'konfirmasi_password'   => 'sometimes|same:password|nullable|min:3',
            'status'                => 'required',
        ]);

        $data = $request->all();

        if ($request->input('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data = Arr::except($data, ['password']);
        }

        $unit->update($data);
        return redirect()->route('unit.index')->with([
            'status' => 'Data unit Berhasil Di Update'
        ]);
    }


    public function destroy(Unit $unit)
    {
        Storage::delete('public/' . $unit->gambar_unit);
        $unit->forceDelete();
        return redirect()->route('unit.index')
            ->with(['status' => 'Data unit Berhasil Dihapus']);
    }
}
