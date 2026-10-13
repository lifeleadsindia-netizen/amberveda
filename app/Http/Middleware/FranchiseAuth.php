<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FranchiseAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('FRANCHISE_LOGIN')) {
            session()->flash('accessMsg', 'Access Denied. Please Login Using your email and Password');
            return redirect('/franchise_panel');
        }
        return $next($request);
    }
}
