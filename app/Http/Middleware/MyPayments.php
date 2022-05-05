<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MyPayments
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
        $userPayment = $request->route('payment')->user_id;
        $user = auth()->user()->id;

        if ($userPayment != $user) {
            return redirect()->route('my-payments');
        }


        return $next($request);
    }
}
