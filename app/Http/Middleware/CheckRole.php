<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next)
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Jika pengguna tidak autentikasi atau tidak memiliki peran
        if (! $request->user() || ! $request->user()->role) {
            abort(403, 'Unauthorized.');
        }

        // Jika peran pengguna tidak termasuk dalam daftar peran yang diizinkan
        if (! in_array($request->user()->role->name, $roles)) {
            abort(403, 'Unauthorized.');
        }

        // return $next($request);


        return $next($request);
    }
}
