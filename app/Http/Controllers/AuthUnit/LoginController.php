<?php

namespace App\Http\Controllers\AuthUnit;

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
        $this->middleware('guest:unit')->except('logoutUnit');
    }

    public function showLoginForm()
    {
        return view('authUnit.login');
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

        if (Auth::guard('unit')->attempt($credential, $request->member)) {
            return redirect()->intended(route('unit.home'));
        } else {
            session()->flash('loginError', 'Email atau password salah, periksa kembali akun anda');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logoutUnit()
    {
        Auth::guard('unit')->logout();
        return redirect('/unit/login');
    }
}
