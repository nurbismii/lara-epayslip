<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class IsAdmin
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
        if(!empty(auth()->user()->status)) {
           if((auth()->user()->level == "Administrator") && (auth()->user()->status == "Aktif")){
               return $next($request);
           }
         }
           \Auth::logout();
           return redirect('/login')->with('warning', 'Opps, Anda Tidak Punya Akses.');
       }
}
