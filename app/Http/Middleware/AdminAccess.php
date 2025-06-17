<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class AdminAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('AdminAccess middleware triggered.');
        Log::info('auth()->check(): ' . (auth()->check() ? 'true' : 'false'));
        Log::info('auth()->user(): ' . json_encode(auth()->user()));

        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Unauthorized access. Admin privileges required.');
        }

        return $next($request);
    }
} 