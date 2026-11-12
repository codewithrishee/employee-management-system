<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // If user is not logged in, redirect to login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Get logged-in user
        $user = auth()->user();

        // Only admin can access admin routes
        if ($user->role !== 'admin') {
            abort(403, 'Access Denied');
        }

        return $next($request);
    }
}
