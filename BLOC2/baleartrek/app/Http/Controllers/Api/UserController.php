<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserRequest;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        // SELECCIÓ DE LES DADES
        $users = User::with(["role"])
                    ->where('status', 'y')
                    ->orderBy('role_id')
                    ->orderBy('id')
                    ->get();

        // SELECCIÓ DEL FORMAT DE LA RESPOSTA
        return (UserResource::collection($users))->additional(['meta' => 'Users mostrats correctament']);  // torna una resposta personalitzada
    }

/*
    public function show($email)
    {
        $user = User::where('email','like', "%".$email ."%")->firstOrFail()
                        ->load(['meeting',
                                'meetings',
                                'comments',
                                'comments.images']);

            // SELECCIÓ DEL FORMAT DE LA RESPOSTA
            return (new UserResource($user))->additional(['meta' => 'Usuari mostrat correctament']); // torna una resposta personalitzada
 
    }
*/
    
    public function show(User $user)
    {   
        // Verificar que l'usuari estigui actiu
        if ($user->status == 'y') {
            // SELECCIÓ DE LES DADES
            $user->load(['meeting',
                         'meetings',
                         'comments',
                         'comments.images']);

            // SELECCIÓ DEL FORMAT DE LA RESPOSTA
            return (new UserResource($user))->additional(['meta' => 'Usuari mostrat correctament']); // torna una resposta personalitzada
        } else {
            // abort(404, 'Usuari no disponible');
            return response()->json(['message' => 'Usuari no disponible'], 404);
        }
    }
 
    public function update(UserRequest $request, User $user)
    {
        if ($user->status !== 'y') {
            // abort(404, 'Usuari no disponible');
            return response()->json(['message' => 'Usuari no disponible'], 404);
        }

        $user->update($request->all());
        return (new UserResource($user))->additional(['meta' => 'Usuari modificat correctament']);
    }
    
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
