<?php

namespace App\Http\Controllers\AuthSiswa;

use App\Http\Controllers\Controller;
use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:siswa')->except('logoutSiswa');
    }

    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama_siswa'    => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'foto'          => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'email'         => 'required|string|email|max:255|unique:siswa',
            'no_telp'       => 'required|between:9,13|unique:siswa',
            'password'      => 'required|string|min:3|confirmed',
            'get_provinsi'  => 'required',
            'get_kabupaten' => 'required',
            'get_kecamatan' => 'required',
            'get_desa'      => 'required'
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
                'foto' => $fileName,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'password' => Hash::make($request->password),
                'alamat_province' => $request->get_provinsi,
                'alamat_district' => $request->get_kabupaten,
                'alamat_sub_district' => $request->get_kecamatan,
                'alamat_village' => $request->get_desa,
            ]);
        }

        Auth::guard('siswa')->login($create_siswa);
        return redirect()->intended(route('front.index'));
    }

    public function registrationForm()
    {
        $response = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi');
        $provinsi = json_decode($response->getBody(), true); 
        return view('authSiswa.register', compact('provinsi'));
    }
}
