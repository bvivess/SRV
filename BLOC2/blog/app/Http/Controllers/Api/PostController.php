<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // SELECCIÓ DE LES DADES
        //$posts = Post::all();
        // $posts = Post::paginate(3);  // crea una sortida amb paginació
        // $posts = Post::with([])->get();  // no té sentit
        $posts = Post::with(["user", "category", "comments"])->get();  // post amb les taules relacionades, més óptima
        // $posts = Post::with(["user", "category", "comments", "comments.images"])->get();
        // $posts = Post::with(["user", "category", "comments", "comments.images"])->paginate(3);

        // SELECCIÓ DEL FORMAT DE LA RESPOSTA
        return response()->json($posts);  // --> torna una resposta serialitzada en format 'json'
        // return (PostResource::collection($posts))->additional(['meta' => 'Posts mostrats correctament']);  // torna una resposta personalitzada
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    //public function show(String $id)
    public function show(Post $post)
    {
        // SELECCIÓ DE LES DADES
        // $post = Post::find($id);  // no cal fer-ho, Laravel ja ho fa de manera implícita
       
        // AFEGINT DADES AMB 'load()'
        // $post->load('user')->load('category')->load('comments')->load('comments.images');

        // AFEGINT DADES AMB 'with()'
        // $newPost = Post::with(["user","category","comments","comments.images"])->find($post->id);

        // SELECCIÓ DEL FORMAT DE LA RESPOSTA
        // return response()->json($newPost);
        // return (new PostResource($newPost))->additional(['meta' => 'Post mostrat correctament']);
       
        return response()->json($post);
        // return (new PostResource($post))->additional(['meta' => 'Post mostrat correctament']);
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
