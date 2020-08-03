<?php

namespace App\Http\Controllers\AuthTutor;

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
        $this->middleware('guest:tutor')->except('logoutTutor');
    }

    public function showLoginForm()
    {
        return view('authTutor.login');
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

        if (Auth::guard('tutor')->attempt($credential, $request->member)) {
            return redirect()->intended(route('tutor.home'));
        } else {
            session()->flash('loginError', 'Periksa kembali login anda');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logoutTutor()
    {
        Auth::guard('tutor')->logout();
        return redirect('/tutor/login');
    }
}
