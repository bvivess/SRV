<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|max:255|unique:users',
            'password'  => 'required|string'
          ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => Hash::make($request->password),
                'role' => 'user',
        ]);
        
        event(new Registered($user));

        $token = $user->createToken('auth_token')->plainTextToken;  // Crea el token en la taula 'personal_acces_tokens'

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }
}
