<?php

namespace App\Http\Controllers\Unit;

use App\Fasilitas;
use App\Galeri;
use App\Http\Controllers\Controller;
use App\KursusUnit;
use App\Mentor;
use Illuminate\Http\Request;
use App\Unit;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Rules\UserOldPassword;
use Illuminate\Support\Str;


class DashboardController extends Controller
{
    public function index()
    {

        $kursus = KursusUnit::with(['unit', 'kursus'])
            ->where('unit_id', Auth::id())
            ->groupBy('kursus_id')
            ->get()
            ->count();

        $mentor = Mentor::where('unit_id', Auth::id())->count();
        $fasilitas = Fasilitas::where('unit_id', Auth::id())->count();
        $galeri = Galeri::where('unit_id', Auth::id())->count();

        return view('unit.dashboard.index', compact('kursus', 'mentor', 'fasilitas', 'galeri'));
    }

    public function profile()
    {
        return view('unit.profile.index');
    }

    public function update_profile(Request $request, $id)
    {
        $user = Unit::findOrFail($id);
        $request->validate([
            'nama_unit'             => 'required|min:3|max:100',
            'deskripsi'             => 'required|min:10',
            'email'                 => 'required|email|unique:unit,email,' . $id,
            'whatsapp'              => 'required',
            'telegram'              => 'required',
            'instagram'             => 'required',
            'username'              => 'required|min:3|max:100|unique:unit,username,' . $id,
            'gambar_unit'           => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar_unit')) {
            if ($request->file('gambar_unit')) {
                if ($user->gambar_unit && file_exists(storage_path('app/public/' . $user->gambar_unit))) {
                    Storage::delete('public/' . $user->gambar_unit);
                    $file = $request->file('gambar_unit')->store('unit', 'public');
                    $data['gambar_unit'] = $file;
                } else {
                    $file = $request->file('gambar_unit')->store('unit', 'public');
                    $data['gambar_unit'] = $file;
                }
            }
        }

        $nama_slug = $data['nama_unit'];
        $data['slug'] = Str::slug($nama_slug, '-');

        $user->update($data);
        return redirect()->back()->with([
            'status' => 'Profile Berhasil Disimpan'
        ]);
    }

    public function update_profile_deskripsi(Request $request, $slug)
    {
        $user = Unit::where('slug', $slug)->first();
        $request->validate([
            'deskripsi' => 'required|min:10',
        ]);

        $data = $request->all();

        $user->update($data);
        return redirect()->back()->with([
            'status' => 'Deskripsi Unit Berhasil Disimpan'
        ]);
    }

    public function update_profile_lokasi(Request $request, $slug)
    {
        $user = Unit::where('slug', $slug)->first();
        $request->validate([
            'alamat'    => 'required|min:3|max:200',
            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
        ]);

        $data = $request->all();

        $user->update($data);
        return redirect()->back()->with([
            'status' => 'Lokasi diupdate'
        ]);
    }

    public function update_profile_banner(Request $request, $slug)
    {
        $user = Unit::where('slug', $slug)->first();
        $request->validate([
            'gambar_unit' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar_unit')) {
            if ($request->file('gambar_unit')) {
                if ($user->gambar_unit && file_exists(storage_path('app/public/' . $user->gambar_unit))) {
                    Storage::delete('public/' . $user->gambar_unit);
                    $file = $request->file('gambar_unit')->store('unit', 'public');
                    $data['gambar_unit'] = $file;
                } else {
                    $file = $request->file('gambar_unit')->store('unit', 'public');
                    $data['gambar_unit'] = $file;
                }
            }
        }

        $user->update($data);
        return redirect()->back()->with([
            'status' => 'Banner Unit Berhasil Disimpan'
        ]);
    }

    public function pengaturan()
    {
        return view('unit.pengaturan.index');
    }

    public function update_pengaturan(Request $request, $id)
    {
        $request->validate([
            'current_password' => ['required', new UserOldPassword],
            'password' => ['required', 'min:3'],
            'konfirmasi_password' => ['same:password'],
        ]);

        $user = Unit::findOrFail($id);
        $user->update(['password' => Hash::make($request->password)]);
        return redirect()->back()->with(['success' => 'Password berhasil diupdate!']);
    }
}
