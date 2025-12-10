<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Role;

class CheckRoleAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Comprovar si està autenticat
        if (!Auth::guard('sanctum')->check()) {
            return response()->json(['message' => 'No autenticat'], 401);
        }

        // Comprovar si és admin
        if (!Auth::guard('sanctum')->user()->isAdmin()) {
            return response()->json(['message' => 'Accés denegat: permisos insuficients'], 403);
        }
                 
        return $next($request);
    }
}
