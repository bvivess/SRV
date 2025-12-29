<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Exception;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validació amb missatges personalitzats
            $validated = $request->validate([
                   'email'     => 'required|string|email',
                    'password' => 'required|string',
                ], [ 'email.required' => 'El correu és obligatori',
                    'email.email'    => 'El correu no té un format vàlid',
                    'password.required' => 'La contrasenyaa és obligatòria',
                ]
            );

            // Intent d'inici de sessió
            if (!Auth::attempt($validated->only('email', 'password'))) {
                return response()->json([
                    'message' => 'Credencials d\'accés invàlides'
                ], 401);
            }

            // Usuari autenticat
            $user = Auth::guard('sanctum')->user();

            // Crear token d'accés
            $token = $user->createToken('auth_token')->plainTextToken;

            // Resposta JSON
            return response()->json([
                'access_token' => $token,
                'token_type'   => 'Bearer',
                'user'         => $user,
                'status'       => 'Login OK successful',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'S\'ha produït un error al tractar les dades',
                'error_details' => $e->getMessage(),
            ], 200);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $token = Auth::guard('sanctum')->user()->currentAccessToken();
            $token->delete();

            return response()->json(['message' => 'Logout OK successful']);
        } catch (Exception $e) {
            // GESTIÓ DE L'ERROR
            // Retorna un JSON amb un missatge d'error i un codi d'estat 500
            return response()->json([
                'message' => 'S\'ha produït un error al tractar les dades',
                // El següent és opcional i només s'hauria de mostrar en entorns de desenvolupament (APP_DEBUG=true)
                'error_details' => $e->getMessage(),
            ], 200);
        }
    }
}