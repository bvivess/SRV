<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Http\Resources\PostResource;
use App\Models\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
            $posts = Post::with([ 'category', 'comments'])  // Consulta inicial
                        ->when($request->title, fn ($q, $title) =>
                                    $q->where('title', 'like', "%$title%")
                        )  // Aplicar filtre 'title'
                        ->when($request->category, fn ($q, $category) =>
                            $q->whereHas('category', fn ($q) =>  // 'whereHas' per a la relació 'category()'
                                $q->where('title', 'like', "%$category%")
                            )
                        )  // Aplicar filtre 'category'
                        ->get();

        return (PostResource::collection($posts))->additional(['meta' => 'Posts mostrats correctament']);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $title)
    {
        // SELECCIÓ DE LES DADES
        //$post = Post::find($id);  // no cal fer-ho, Laravel ja ho fa de manera implícita
       
        // AFEGINT DADES DE JOIN AMB 'load()'
        //$post->load('user')->load('category')->load('comments')->load('comments.images');

        // AFEGINT DADES DE JOIN AMB 'with()'
        $newPost = Post::where('title', 'like', '%' . $title .'%' )->firstOrFail();

        // SELECCIÓ DEL FORMAT DE LA RESPOSTA
        return response()->json($newPost);
        // return (new PostResource($newPost))->additional(['meta' => 'Post mostrat correctament']);
       
        //return response()->json($post);
        // return (new PostResource($post))->additional(['meta' => 'Post mostrat correctament']);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    // public function store(PostRequest $request)
    {
        // CREACIÓ DE LES DADES
        $post = Post::create(
            [   // Cal habilitar aquests atributs en Model->'$fillable'
                'title' => $request->title,
                'url_clean' => $request->url_clean,
                'content' => $request->content,
                'user_id' => $request->user_id,  // Auth::user()->id; (si s'empra la verificació d'usuari)
                'category_id' => $request->category_id,
            ]
        );
        // Post M:N Tags
        foreach ( explode(',', $request->tags) as $tag)  // converteix l'string '$request->tags'en array
            $newTag = Tag::firstOrCreate(['name' => $tag]);  // crea el 'tag' si no existeix
            $post->tags()->attach($newTag->id);  // crea el 'post_tag' segons '$post->id' i '$newTag->id'

        // SELECCIÓ DEL FORMAT DE LA RESPOSTA
        return response()->json($post);
        //return (new PostResource($post))->additional(['meta' => 'Post modificat correctament']);
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
