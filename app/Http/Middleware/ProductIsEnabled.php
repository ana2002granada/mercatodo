<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class ProductIsEnabled.
 */
class ProductIsEnabled
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        $product = $request->route('product');

        if ($product->disabled_at != null) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
