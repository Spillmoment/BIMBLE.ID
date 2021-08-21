<?php

namespace App\Http\Controllers\AuthManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:manager')->except('logoutManager');
    }

    public function showLoginForm()
    {
        return view('authManager.login');
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

        if (Auth::guard('manager')->attempt($credential, $request->member)) {
            return redirect()->intended(route('dashboard'));
        } else {
            session()->flash('loginError', 'Email atau password salah, periksa kembali akun anda');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logoutManager()
    {
        Auth::guard('manager')->logout();
        return redirect('/manager/login');
    }
}
