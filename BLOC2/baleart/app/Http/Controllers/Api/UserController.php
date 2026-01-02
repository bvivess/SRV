<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use App\Http\Requests\GuardarUserRequest;
use App\Models\Comment;

class UserController extends Controller
{

    public function show(User $user)
    {
        // AFEGINT DADES AMB 'load()'
        $user->load('spaces')->load('comments')->load('comments.images');
        //return response()->json($space);
        return (new UserResource($user))->additional(['meta' => 'Usuari mostrat correctament']);
    }

    public function update(GuardarUserRequest $request, User $user)
    {
        // MODIFICACIÓ DE LES DADES
        try {
            $user->update($request->all());
        } catch (\Exception $e) {
            return (new UserResource($user))->additional(['meta' => 'Error al modificar l\'usuari' . $e->getMessage()]);
        }
        
        // SELECCIÓ DEL FORMAT DE LA RESPOSTA
        return (new UserResource($user))->additional(['meta' => 'Usuari modificat correctament']);
    }

    public function destroy(User $user)
    {
        // ELIMINACIÓ DE LES DADES
        try {
            $comments = Comment::where('user_id',$user->id);
            foreach ($comments as $comment) {
                $images = Images::where('comment_id',$comment->id);
                foreach ($images as $image) {
                    $image->delete();
                }

                $comment->delete();
            }

            $user->delete();
        } catch (\Exception $e) {
            return (new UserResource($user))->additional(['meta' => 'Error al eliminar l\'usuari: ' . $e->getMessage()]);
        }
                
        // SELECCIÓ DEL FORMAT DE LA RESPOSTA
        return (new UserResource($user))->additional(['meta' => 'Usuari eliminat correctament']);
    }
}
