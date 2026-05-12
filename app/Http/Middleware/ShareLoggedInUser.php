<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class ShareLoggedInUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!Auth::check()) {
            // If not logged in, skip this middleware
            return $next($request);
        }

        $loggedUser = auth()->user();
        $role = $loggedUser->roles()->first();

        $userDetails = User::where('id',$loggedUser->id)->first();

        View::share(['loggedUserDetails' => $userDetails, 'role' => $role]);

        return $next($request);
    }
}
