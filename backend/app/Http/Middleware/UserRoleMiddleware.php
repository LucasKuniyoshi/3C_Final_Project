<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check() || Auth::user()->user_type !== $role) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
