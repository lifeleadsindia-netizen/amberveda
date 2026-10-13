<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!$request->session()->has('ADMIN_LOGIN')) {
            session()->flash('accessMsg', 'Access Denied. Please Login Using your email and Password');
            return redirect('/zippkart_cpanel');
        }
        return $next($request);
    }
}
