<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FromHeaderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): ?Response
    {
        if (!$request->headers->has('from') ||  !in_array($request->header('from'),['application','website'])){
            return response()->json([
                'status' => 'error',
                'message' => 'must have from header',
            ], 403);
        }

        return $next($request);
    }
}
