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
        $info =  unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
        if ($info['geoplugin_countryName'] == 'Myanmar') {
            return response(view('errors.isneedvpn'));
        }
        // return view('errors.isneedvpn');
        return $next($request);
    }
}
