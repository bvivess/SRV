<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Image;
use App\Models\Space;
use App\Models\Comment;
use App\Http\Resources\Api\SpaceResource;
use App\Http\Resources\Api\CommentResource;
use App\Http\Requests\GuardarCommentRequest;

class SpaceController extends Controller
{
    
/*
    public function index()
    {
        // SELECCIÓ DE LES DADES
        //$spaces = Space::all();
        $spaces = Space::with(["address", "modalities", "services", "spaceType", "comments", "comments.images", "user"])->get();

        // SELECCIÓ DE LA RESPOSTA
        //return response()->json($spaces);  // --> torna una resposta serialitzada en format 'json'
        return (SpaceResource::collection($spaces))->additional(['meta' => 'Espais mostrats correctament']);  // torna una resposta personalitzada
    }
*/

    public function index(Request $request)
    {
        // Construcció de la consulta inicial amb les relacions necessàries
        $query = Space::with([
            "address",
            "address.municipality.island",
            "modalities",
            "services",
            "spaceType",
            "comments",
            "comments.images",
            "user",
        ]);

        // Aplicar filtre per 'illa' només si el paràmetre està present
        $query->when($request->illa, function ($q) use ($request) {
            $q->whereHas('address.municipality.island', function ($q) use ($request) {
                                                            $q->where('name', $request->illa);
                                                        }
                        );
        });

        // Obtenir els resultats
        $spaces = $query->get();

        // Retornar la resposta com a col·lecció de recursos personalitzada
        return (SpaceResource::collection($spaces))->additional(['meta' => 'Espais mostrats correctament']);
    }

    public function show(Space $space)
    {
        // AFEGINT DADES AMB 'load()'
        $space->load('address')->load('modalities')->load('services')->load('spaceType')->load('comments')->load('comments.images')->load('user');
        //return response()->json($space);
        return (new SpaceResource($space))->additional(['meta' => 'Espai mostrat correctament']);
    }

    // public function store(Request $request)
    public function store(Request $request)
    {
        $space_id = Space::where('regNumber', $request->regNumber)->first()->id;
        $ncomentaris=0; $nimatges=0;

        foreach ($request->comments as $comment) {
            $c = Comment::create(
                [
                    'comment' => $comment['comment'],
                    'score' => $comment['score'],
                    'user_id' => Auth::check() 
                                    ? Auth::id() 
                                    : ($request->has('email') 
                                        ? User::where('email', $request->email)->first()->id
                                        : User::where('name', 'admin')->value('id')),
                    'space_id' => $space_id,
                ]
            );
            $ncomentaris++;

            foreach ($comment['images'] as $image) {                
                $i = Image::create(
                    [
                        'comment_id' => $c->id,
                        'url' => $image['url'],
                    ]
                );
                $nimatges++;
            }
        }

        return response()->json(['meta' => $ncomentaris . ' comentaris creats correctament amb ' . $nimatges . ' imatges']);  
        //return (new CommentResource($comment))->additional(['meta' => 'Comentaris creats correctament']);
    }
}
