<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnitRequest;
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


    public function store(UnitRequest $request)
    {
        $data = $request->all();
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


    public function update(UnitRequest $request, Unit $unit)
    {

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
