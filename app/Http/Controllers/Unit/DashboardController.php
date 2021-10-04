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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\UserOldPassword;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


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

        $response = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=3513');
        $kecamatan = json_decode($response->getBody(), true); 
        // dd($kecamatan);

        return view('unit.dashboard.index', compact('kursus', 'mentor', 'fasilitas', 'galeri', 'kecamatan'));
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

        if (!empty($data['gambar_unit'])) {
            File::delete(public_path('assets/images/unit/' . $user->gambar_unit));
            $nama_foto = rand(1, 999) . "-" . $data['gambar_unit']->getClientOriginalName();
            $data['gambar_unit'] = Image::make($data['gambar_unit']->getRealPath());
            $data['gambar_unit']->resize(500, 300);
            $data['gambar_unit']->save(public_path('assets/images/unit/' . $nama_foto));
            $data['gambar_unit'] = $nama_foto;
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
        // dd($request->get_kecamatan, $request->get_desa);
        $user = Unit::where('slug', $slug)->first();
        $request->validate([
            // 'alamat'    => 'required|min:3|max:200',
            'get_kecamatan'    => 'required',
            'get_desa'    => 'required',
            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
        ]);

        if ($request->get_kecamatan == '0' || $request->get_desa == '0') {
            $user->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude
            ]);
        } else {
            $user->update([
                'alamat' => $request->kecamatan.' - '.$request->get_desa,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude
            ]);
        }

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

        if (!empty($data['gambar_unit'])) {
            File::delete(public_path('assets/images/unit/' . $user->gambar_unit));
            $nama_foto = rand(1, 999) . "-" . $data['gambar_unit']->getClientOriginalName();
            $data['gambar_unit'] = Image::make($data['gambar_unit']->getRealPath());
            $data['gambar_unit']->resize(500, 300);
            $data['gambar_unit']->save(public_path('assets/images/unit/' . $nama_foto));
            $data['gambar_unit'] = $nama_foto;
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
