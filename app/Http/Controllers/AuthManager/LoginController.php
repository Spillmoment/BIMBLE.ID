<?php

namespace App\Http\Controllers\AuthManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
            session()->flash('loginError', 'Periksa kembali login anda');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logoutManager()
    {
        Auth::guard('manager')->logout();
        return redirect('/manager/login');
    }
}
