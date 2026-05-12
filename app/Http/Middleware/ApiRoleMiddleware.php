<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\APIResponseMessage;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class ApiRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle(Request $request, Closure $next, $role = null)
    {
        if ($request->is('api/login') || $request->is('api/register')) {
            return $next($request);
        }

        if ($request->is('api/*')) {
            $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => APIResponseMessage::UNAUTHORIZED_USER,
            ], 401);
        }

        if (!$user->hasRole($role)) {
            return response()->json([
                'message' => APIResponseMessage::UNAUTHORIZED_ROLE,
            ], 403);
        }
    
            return $next($request);
        }
    
        return $next($request);
    }
    
}
