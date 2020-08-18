<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UnitController extends Controller
{

    public function index(Request $request)
    {
        return view('admin.unit.index', [
            'unit' => Unit::where('status', '1')
                ->latest()->get()
        ]);
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
