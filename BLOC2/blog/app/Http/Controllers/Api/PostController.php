<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Requests\GuardarPostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $posts = Post::all();
        // $posts = Post::paginate(3);  // crea una sortida amb paginació
        $posts = Post::all();  // post sense les taules relacionades
        //$posts = Post::with([])->get();  // post amb les taules relacionades, més óptima
        //$posts = Post::with(["category", "users",  "comments.images"])->get();  // post amb les taules relacionades, més óptima
        //$posts = Post::with(["category", "users",  "comments.images"])->paginate(3);  // post amb les taules relacionades, paginada
        return response()->json($posts);  // --> torna una resposta serialitzada en format 'json'
        //return (PostResource::collection($posts))->additional(['meta' => 'Posts mostrats correctament']);  // torna una resposta personalitzada
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load('category')->load('users')->load('comments.images');
        //return response()->json($post);
        return (new PostResource($post))->additional(['meta' => 'Post mostrat correctament']);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request $request)
    public function store(GuardarPostRequest $request)
    {
        $data = $request->all();
        $data["user_id"] = User::all()->random()->id;  // cal modificar per l'usuari connectat 
                                                       // Auth::user()->id; (si s'empra la verificació d'usuari)
        //dd($data);
        $post = Post::create($data);

        // return response()->json(['meta' => 'Post creat correctament']);
        // return response()->json($post);
        // return response()->json([
        //     'data' => $post, // Aquí incloem el post creat
        //     'meta' => 'Post creat correctament', // Metadada personalitzada
        // ], 201); // 201 indica que s'ha creat un nou recurs
        return (new PostResource($post))->additional(['meta' => 'Post creat correctament']);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(PostRequest $request, Post $post)
    public function update(GuardarPostRequest $request, Post $post)
    {
        $post->update($request->all());
        return (new PostResource($post))->additional(['meta' => 'Post modificat correctament']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return (new PostResource($post))->additional(['msg' => 'Post eliminat correctament']);
    }


    public function prova()    // PER EXEMPLE
    {
        return response()->json(['data' => 'Això és una prova']);
    }
    
}