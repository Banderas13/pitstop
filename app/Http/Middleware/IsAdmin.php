<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IsAdmin
{
    /*public function handle($request, Closure $next)
    {
        Log::info('AdminAccess middleware triggered.');
        Log::info('auth()->check(): ' . (auth()->check() ? 'true' : 'false'));
        Log::info('auth()->user(): ' . json_encode(auth()->user()));

        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        abort(403, 'Toegang geweigerd.');
    }*/
}