<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Exception;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with(["posts", "comments","posts","comments.images"])->get(); 
        return UserResource::collection($users)->additional(['meta' => 'Usuari mostrat correctament']);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load('posts')->load('comments')->load('posts')->load('comments.images'); 
        return (new UserResource($user))->additional(['meta' => 'Usuari mostrat correctament']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $text = 'Usuari insertat correctament';
        return response()->json($text);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $text = 'Usuari actualitzat correctament';
        return response()->json($text);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            //$user->status = 'n';
            //$user->save();
            $user->delete();
            
            return (new UserResource($user))->additional(['meta' => 'Usuari eliminat correctament']);
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
