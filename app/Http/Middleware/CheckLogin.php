<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckLogin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika belum login
        if (!Session::get('login')) {

            // Izinkan membuka halaman login
            if ($request->is('login')) {
                return $next($request);
            }

            // Selain login, arahkan ke halaman login
            return redirect('/login');
        }

        return $next($request);
    }
}