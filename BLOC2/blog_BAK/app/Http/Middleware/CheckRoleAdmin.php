<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1) Si no està autenticat -> 401
        if (! Auth::check()) {
            return response()->json(['message' => 'No autenticat'], 401);
        }

        // 2) Comprova el rol (si role és relació -> role->name)
        $user = Auth::user();
        $roleName = data_get($user, 'role.name'); // utilitza data_get per evitar errors si no existeix la relació

        if ($roleName !== 'admin') {
            return response()->json(['message' => 'Accés denegat: permisos insuficients'], 403);
        }

        // 3) Tot OK -> segueix la request
        return $next($request);
    }

}