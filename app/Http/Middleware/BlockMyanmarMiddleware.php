<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockMyanmarMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()) {
            if (Auth::user()->role == 'member' || Auth::user()->role == 'admin') {
                return $next($request);
            }
        }
        if (get_user_country() == 'Myanmar') {
            return response(view('errors.isneedvpn'));
        }
        // return view('errors.isneedvpn');
        return $next($request);
    }
}
