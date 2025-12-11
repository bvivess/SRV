<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate(
                [   'name'      => 'required|string|max:255',
                    'lastname'  => 'required|string|max:255',
                    'email'     => 'required|string|email|max:255|unique:users',
                    'password'  => 'required|string|min:8',
                ], [
                    'name.required'      => 'El nom és obligatori.',
                    'lastname.required'  => 'El cognom és obligatori.',
                    'email.required'     => 'L\'email és obligatori.',
                    'email.email'        => 'L\'email no té un format correcte.',
                    'email.unique'       => 'Aquest email ja està registrat.',
                    'password.required'  => 'La contrasenya és obligatòria.',
                    'password.min'       => 'La contrasenya ha de tenir almenys 8 caràcters.',
                ]
            );

            // Creació de l'usuari
            $user = User::create([
                'name'               => $validated['name'],
                'lastname'           => $validated['lastname'],
                'email'              => $validated['email'],
                'email_verified_at'  => now(),
                'password'           => Hash::make($validated['password']),
                'role_id'            => Role::where('name', 'visitant')->value('id'),
            ]);
        
            event(new Registered($user));

            $token = $user->createToken('auth_token')->plainTextToken;  // Crea el token en 'personal_acces_tokens'

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ]);
        } catch (Exception $e) {

            return response()->json([
                'message' => 'S\'ha produït un error al tractar les dades',
                'error_details' => $e->getMessage(),
            ], 200);
        }
    }
}