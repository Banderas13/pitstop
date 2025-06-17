<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /*public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and is admin
        if (!auth()->check()) {
            return redirect()->route('filament.admin.auth.login');
        }
        
        if (auth()->user()->is_admin !== 1) {
            abort(403, 'Access denied. Admin privileges required.');
        }
        
        return $next($request);
    }*/
}