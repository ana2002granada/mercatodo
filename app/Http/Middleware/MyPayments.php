<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MyPayments
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        $userPayment = $request->route('payment')->user_id;
        $user = auth()->user()->id;

        if ($userPayment != $user) {
            return redirect()->route('my-payments');
        }

        return $next($request);
    }
}
