<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckActiveRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (session()->has('active_role')) {
            // Ubah peran user aktif sesuai dengan peran yang ada di session
            $activeRole = session('active_role');
            Auth::user()->level_id = $activeRole;
        }

        return $next($request);
    }
}
