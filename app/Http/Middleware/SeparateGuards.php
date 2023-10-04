<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SeparateGuards
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('client')->check() && ($request->is('admin/*') || $request->is('admin'))) {
            abort(404);
        }

        if (Auth::guard('web')->check() && $request->is('client/*')) {
            abort(404);
        }

        return $next($request);
    }
}
