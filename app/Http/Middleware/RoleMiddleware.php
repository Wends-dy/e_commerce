<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
 
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle($request, Closure $next, ...$roles)
    // {
    //     if (!auth()->check() || !auth()->user()->hasAnyRole($roles)) {
    //         return redirect('/home'); // Redirect if unauthorized
    //     }
    
    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next, string $role)
    {
        if (Auth::check()) {
            // Check if the authenticated user has the specified role
            if (Auth::user()->hasRole($role)) {
                return $next($request);
            }
            return abort(401, 'Unauthorized access');
        }

        return abort(401, 'Unauthorized access');
    }
}
