<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
//        return $request->expectsJson() ? null : route('admin.login');
        if (! $request->expectsJson()) {

            if(Route::is('client.*')){
                return route('client.login');
            }elseif (Route::is('admin.*')){
                return route('admin.login');
            }else{
                return route('admin.login');
            }
        }
        return null ;
    }
}
