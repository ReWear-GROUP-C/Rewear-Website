<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role = 'admin'): Response
    {
        $user = Auth::user();

        if (!$user || $user->role !== $role) {
            abort(403, 'Access denied.');
        }

        return $next($request);
    }
}
