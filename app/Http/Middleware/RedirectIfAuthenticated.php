<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'manager':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('dashboard');
                }
                break;

            case 'tutor':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('tutor.home');
                }
                break;

            default:
                if (Auth::guard($guard)->check()) {
                    return redirect()->back();
                }
                break;
        }

        return $next($request);
    }
}
