<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use App\Rules\UserOldPassword;
use App\Kursus;
use App\Siswa;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        $response = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi');
        $provinsi = json_decode($response->getBody(), true); 
        return view('web.web_profile', compact('provinsi'));
    }

    public function pengaturan()
    {
        return view('web.web_profile');
    }

    public function update_profile(Request $request, $id)
    {

        $request->validate([
            'nama_siswa'    => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            // 'agama'         => 'required|string|max:255',
            'foto'          => 'nullable|sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'username'      => 'required|string|max:255|unique:siswa,username,' . $id,
            'email'         => 'required|string|email|max:255|unique:siswa,email,' . $id,
            'alamat'        => 'required'
        ]);

        $user = Siswa::findOrFail($id);

        if ($request->hasFile('foto')) {
            File::delete('storage/siswa/' . $user->foto);
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . "." . $extension;
            $file->move('storage/siswa', $fileName);

            $user->update([
                'nama_siswa' => $request->nama_siswa,
                'email' => $request->email,
                'jenis_kelamin' => $request->jenis_kelamin,
                'username' => $request->username,
                'alamat' => $request->alamat,
                'foto' => $fileName,
            ]);
        } else {
            $user->update([
                'nama_siswa' => $request->nama_siswa,
                'email' => $request->email,
                'jenis_kelamin' => $request->jenis_kelamin,
                'username' => $request->username,
                'alamat' => $request->alamat,
            ]);
        }

        return back()->with(['success' => 'Profil']);
    }

    public function update_pengaturan(Request $request, $id)
    {
        $request->validate([
            'current_password' => ['required', new UserOldPassword],
            'password' => ['required', 'min:3'],
            'konfirmasi_password' => ['same:password'],
        ]);

        $user = Siswa::findOrFail($id);
        $user->update(['password' => Hash::make($request->password)]);;
        return redirect()->back()->with(['success' => 'Password berhasil diupdate!']);
    }
}
