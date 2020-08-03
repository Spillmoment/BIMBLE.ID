<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Kursus;
use App\OrderDetail;
use App\Pendaftar;
use Illuminate\Http\Request;
use App\Tutor;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Rules\UserOldPassword;
use App\Siswa;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $kursus = Kursus::with('tutor')
            ->where('id_tutor', Auth::id())->count();
        $jumlah_siswa = Siswa::with('tutor')
            ->where('id_tutor', Auth::id())->count();
        $jumlah_pendaftar = DB::table('order_detail')
                            ->join('kursus', 'order_detail.id_kursus', '=', 'kursus.id')
                            ->select('order_detail.*')
                            ->where('order_detail.status', '=', 'SUCCESS')
                            ->where('kursus.id_tutor', '=', Auth::id())
                            ->count();

        return view('tutor.dashboard.index', [
            'kursus'    => $kursus,
            'siswa'     => $jumlah_siswa,
            'pendaftar' => $jumlah_pendaftar
        ]);
    }

    public function profile()
    {
        $user =  Tutor::where('id', Auth::id())->get();
        return view('tutor.profile.index', [
            'tutor' => $user
        ]);
    }

    public function update_profile(Request $request, $id)
    {
        $user = Tutor::findOrFail($id);
        $request->validate([
            'nama_tutor'            => 'required|min:3|max:100',
            'alamat'                => 'required|min:3|max:200',
            'email'                 => 'required|email|unique:tutor,email,' . $id,
            'foto'                  => 'sometimes|nullable|image|mimes:jpg,jpeg,png,bmp',
            'username'              => 'required|min:3|max:100|unique:tutor,username,' . $id,
            'keahlian'              => 'required',
        ]);

        $data = $request->all();


        if ($request->hasFile('foto')) {
            if ($request->file('foto')) {
                if ($user->foto && file_exists(storage_path('app/public/' . $user->foto))) {
                    Storage::delete('public/' . $user->foto);
                    $file = $request->file('foto')->store('tutor', 'public');
                    $data['foto'] = $file;
                }
            }
        }

        $user->update($data);
        return redirect()->back()->with([
            'status' => 'Profile Berhasil Disimpan'
        ]);
    }

    public function pengaturan()
    {
        return view('tutor.pengaturan.index');
    }

    public function update_pengaturan(Request $request, $id)
    {
        $request->validate([
            'current_password' => ['required', new UserOldPassword],
            'password' => ['required', 'min:3'],
            'konfirmasi_password' => ['same:password'],
        ]);

        $user = Tutor::findOrFail($id);
        $user->update(['password' => Hash::make($request->password)]);;
        return redirect()->back()->with(['success' => 'Password berhasil diupdate!']);
    }
}
