<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsEnabled
{
    public function handle(Request $request, Closure $next)
    {
        if (optional(auth()->user())->disabled_at) {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error', 'Usuario inhabilitado');
        }

        return $next($request);
    }
}
