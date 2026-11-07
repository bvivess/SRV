<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MultiAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Intenta autenticar amb Sanctum
        if (Auth::guard('sanctum')->check()) {
            return $next($request);
        }

        // Intenta validar amb API Key
        $apiKey = $request->header('X-API-KEY');
        if ($apiKey && $apiKey === env('APP_KEY')) {
            return $next($request);
        }

        // Si cap de les dues funciona, retorna no autoritzat
        return response()->json(['Error' => 'Unauthorized'], 401);
    }
}

