<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasTwoFactorEnabled
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        if (!$request->user()->phone_verified_at) {
            return redirect()->route('user.activate2fa');
        }

        return $next($request);
    }
}
