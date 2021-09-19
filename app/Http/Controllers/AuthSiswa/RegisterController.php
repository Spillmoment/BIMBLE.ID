<?php

namespace App\Http\Controllers\AuthSiswa;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Siswa;

// use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register (Request $request)
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
            $fileName = time(). "." .$extension;
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
    // public function register(Request $request)
    // {
    //     dd($request->all());
    //     $this->validator($request->all())->validate();

    //     event(new Registered($user = $this->create($request->all())));

    //     $this->guard()->login($user);

    //     if ($response = $this->registered($request, $user)) {
    //         return $response;
    //     }

    //     return $request->wantsJson()
    //                 ? new JsonResponse([], 201)
    //                 : redirect($this->redirectPath());
    // }

    // protected function guard()
    // {
    //     return Auth::guard('siswa');
    // }

    // protected function registered(Request $request, $user)
    // {
    //     return Auth::loginUsingId($user->id);
    // }

    public function registrationForm()
    {
        return view('authSiswa.register');
    }

    // protected $redirectTo = '/siswa/home';

    // public function __construct()
    // {
    //     $this->middleware('guest:siswa');
    // }

    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'nama_siswa' => ['required', 'string', 'max:255'],
    //         'jenis_kelamin' => ['required', 'in:L,P'],
    //         'agama' => ['required', 'string', 'max:255'],
    //         'alamat' => ['required', 'string', 'max:255'],
    //         'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    //         'username' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:siswa'],
    //         'password' => ['required', 'string', 'min:3', 'confirmed'],
    //     ]);
    // }

    // protected function create(array $data)
    // {
    //     $fileName = null;
    //     if (request()->hasFile('foto')) {
    //         $file = request()->file('foto');
    //         $extension = $file->getClientOriginalExtension();
    //         $fileName = time(). "." .$extension;
    //         $file->move('storage/siswa', $fileName);  
    //         // file logo

    //         //input nama
    //         return Siswa::create([
    //             'nama_siswa' => $data['nama_ukm'],
    //             'jenis_kelamin' => $data['jenis_kelamin'],
    //             'agama' => $data['agama'],
    //             'alamat' => $data['alamat'],
    //             'foto' => $fileName,
    //             'username' => $data['username'],
    //             'email' => $data['email'],
    //             'password' => Hash::make($data['password']),
    //             'status' => 1,
    //         ]);
    //     }

    // }
}
