<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MultiAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-KEY');  // Obtenir la clau API de la capçalera

        if (Auth::guard('sanctum')->check() || ($apiKey && $apiKey === env('APP_KEY'))) {  // Comprovar autenticació amb Sanctum o clau API
            return $next($request);
        } else {
            return response()->json(['Error' => 'Usuari no autoritzat'], 401);
        }
    }
}

