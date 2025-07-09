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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if unauthenticated
        }

        // Get the authenticated user's role
        $userRole = Auth::user()->role;

        // Get the route name
        $routeName = $request->route()->getName();

        // Define role-specific access rules
        if (
            ($userRole === 'admin' && str_starts_with($routeName, 'admin')) ||
            ($userRole === 'user' && $routeName === 'dashboard') ||
            ($userRole === 'employee' && str_starts_with($routeName, 'employee'))
        ) {
            // Grant access if role matches the route pattern
            return $next($request);
        }

        // Prevent redirect loops by checking current route
        if ($userRole === 'admin' && $routeName !== 'admin.dashboard') {
            return redirect()->route('admin.dashboard'); // Redirect admin to their dashboard
        } elseif ($userRole === 'user' && $routeName !== 'dashboard') {
            return redirect()->route('dashboard'); // Redirect user to their dashboard
        } elseif ($userRole === 'employee' && !str_starts_with($routeName, 'employee')) {
            return redirect()->route('employee.dashboard'); // Redirect employee to their dashboard
        }

        // Abort if no matching rule is found
        abort(403, 'Unauthorized access');
    }
}
