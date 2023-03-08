<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiPasswordMiddleWare
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
        $key = config('app.api_password_key');
        if ($request->header('ApiPassword') == $key) {
            return $next($request);
        }
        return response()->json(['error','Unknown Request!'], 403);
    }
}
