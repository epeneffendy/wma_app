<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // dd($request);
        if(auth()->check()){
            // if(auth()->user()->type == 'superadmin'){
                return $next($request);
            // }
        }
        return redirect('login')->with('error', "Kamu tidak memiliki akses");
    }
}
