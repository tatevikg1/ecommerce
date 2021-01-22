<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class Administrator
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
        if (Auth::id() != 1) {
            abort(404);
            // return redirect(RouteServiceProvider::HOME);
        }
        return $next($request);
    }
}
