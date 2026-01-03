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

        if ( Auth::guard('sanctum')->check() ||   // Comprovar autenticació amb 'Sanctum'
            ($apiKey && $apiKey === env('APP_KEY')) ) {  // Comprovar autenticació 'API_Key'
            return $next($request);
        } else {
            return response()->json(['Error' => 'Usuari no autoritzat'], 401);
        }
    }
}

