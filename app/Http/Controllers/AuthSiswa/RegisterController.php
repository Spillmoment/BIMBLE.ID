<?php

namespace App\Http\Controllers\AuthSiswa;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Siswa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama_siswa'    => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'agama'         => 'required|string|max:255',
            'alamat'        => 'required|string|max:255',
            'foto'          => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'username'      => 'required|string|max:255|unique:siswa',
            'email'         => 'required|string|email|max:255|unique:siswa',
            'password'      => 'required|string|min:3|confirmed',
        ]);

        $fileName = null;
        if (request()->hasFile('foto')) {
            $file = request()->file('foto');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . "." . $extension;
            $file->move('storage/siswa', $fileName);
            // file logo

            //input nama
            $create_siswa = Siswa::create([
                'nama_siswa' => $request->nama_siswa,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'alamat' => $request->alamat,
                'foto' => $fileName,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 1,
            ]);
        }

        return Auth::guard('siswa')->login($create_siswa);
    }

    public function registrationForm()
    {
        return view('authSiswa.register');
    }
}
