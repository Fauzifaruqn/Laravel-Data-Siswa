<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

// jika satu role
/*

public function handle($request, Closure $next,$roles)
    {
        if($request->user()->role == $roles)){

            return $next($request);
        }

        return redirect('/');

    }
    */

    //  Jika role yang diberikan hak akses lebih dari satu menggunakan array
    public function handle($request, Closure $next,...$roles)
    {
        if(in_array($request->user()->role,$roles)){

            return $next($request);
        }

        return redirect('/');

    }
}
