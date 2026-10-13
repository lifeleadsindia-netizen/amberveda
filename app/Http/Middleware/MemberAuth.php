<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MemberAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!$request->session()->has('MEMBER_LOGIN')) {
            session()->flash('accessMgs', 'Access Denied. Please Login using your Email and Password');
            return redirect('/member');
        }
        return $next($request);
    }
}
