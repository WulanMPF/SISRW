<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\CekRole;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        Log::info('Checking role in middleware');
        if (!CekRole::check($role)) {
            Log::warning('Unauthorized access attempt');
            return redirect()->route('login')->with('error', 'Unauthorized access attempt');
        }

        return $next($request);
    }
}
