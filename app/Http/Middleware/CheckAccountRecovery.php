<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAccountRecovery
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if ($user && Auth::viaRemember()) {
            $request->session()->put('account_recovery_version', (int) $user->account_recovery_version);
        }
        if ($user && (int) $request->session()->get('account_recovery_version', 0)
            !== (int) $user->account_recovery_version) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('status',
                'Akun telah dipulihkan. Silakan masuk kembali dengan data akun terbaru.');
        }

        return $next($request);
    }
}
