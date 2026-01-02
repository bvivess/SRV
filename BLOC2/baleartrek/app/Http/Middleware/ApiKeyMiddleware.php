<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiKeyMiddleware
{
    /**
     * Maneja una petició entrant.
     */
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('x-api-key'); // Obtenir la clau des de les capçaleres
       
        if ($apiKey !== env('APP_KEY')) {
            return response()->json(['Error' => 'Clau invàlida'], 401);
        }
        
        return $next($request); // Continuar si la clau és vàlida
    }
}
