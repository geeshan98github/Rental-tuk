<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('frontend')->check()) {
            // Redirect unauthenticated users to login page
            return redirect()->route('login'); // Adjust the route name as needed
        }

        return $next($request);
    }
}