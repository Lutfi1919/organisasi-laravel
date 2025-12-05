<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class isGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() == FALSE) {
            // jika check false (belum login), boleh akses
            return $next($request);
        } else {
            // jika sudah login
            if (Auth::user()->admin == 'admin') {
                // jika role admin, ke admin.dashboard
                return redirect()->route('admin.dashboard');
            } else {
                // selain admin ke home
                return redirect()->route('home')->with('errorMid', 'Tidak bisa mengakses halaman tersebut!');;
            }
        }
    }
}
