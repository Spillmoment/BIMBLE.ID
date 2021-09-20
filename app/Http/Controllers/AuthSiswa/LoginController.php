<?php

namespace App\Http\Controllers\AuthSiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:siswa')->except('logoutSiswa');
    }

    public function showLoginForm()
    {
        return view('authSiswa.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);

        $credential = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('siswa')->attempt($credential, $request->member)) {
            return redirect()->intended(route('front.index'));
        } else {
            session()->flash('loginError', 'Email atau password salah, periksa kembali akun anda');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logoutSiswa()
    {
        Auth::guard('siswa')->logout();
        return redirect('/siswa/login');
    }
}
