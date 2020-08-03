<?php

namespace App\Http\Middleware;

use App\Kursus;
use App\OrderDetail;
use Closure;
use Illuminate\Support\Facades\Auth;

class CekKursusMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id_pendaftar = Auth::user()->id;
        $id_kursus = Kursus::where('slug', $request->route('slug'))->first()->id;
        $cek_status = OrderDetail::where('id_pendaftar', $id_pendaftar)
            ->where('id_kursus', $id_kursus)
            ->where('status', 'SUCCESS')
            ->first();

        if ($cek_status) {
            return $next($request);
        }
        return redirect()->back();
    }
}
