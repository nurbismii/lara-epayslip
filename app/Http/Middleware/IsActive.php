<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Alert;


class IsActive
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
    if (!empty(auth()->user()->status)) {
      if (strtolower(auth()->user()->status) == "aktif" || strtolower(auth()->user()->status) == "tidak aktif") {
        return $next($request);
      }
    }
    \Auth::logout();
    return redirect('/login')->with('warning', 'Maaf User Anda Belum di Aktif, Silahkan Verifikasi Email Anda Terlebih Dahulu.');
  }
}
