<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Requests\GuardarPostRequest;

class PostController extends Controller
{
    public function index()
    {
        // SELECCIÓ DE LES DADES
        $posts = Post::all();
        // $posts = Post::paginate(3);  // crea una sortida amb paginació
        // $posts = Post::with([])->get();  // no té sentit
        // $posts = Post::with(["user", "category", "comments"])->get();  // post amb les taules relacionades, més óptima
        // $posts = Post::with(["user", "category", "comments", "comments.images"])->get();
        // $posts = Post::with(["user", "category", "comments", "comments.images"])->paginate(3);  // post amb les taules relacionades, paginada

        // SELECCIÓ DE LA RESPOSTA
        return response()->json($posts);  // --> torna una resposta serialitzada en format 'json'
        // return (PostResource::collection($posts))->additional(['meta' => 'Posts mostrats correctament']);  // torna una resposta personalitzada
    }

    public function show(Post $post)
    {
        // SELECCIÓ DE LES DADES
        // Post::find($id);  // no cal fer-ho, Laravel ja ho fa de manera implícita

        // AFEGINT DADES AMB 'load()'
        // $post->load('user')->load('category')->load('comments')->load('comments.images');
        
        // AFEGINT DADES AMB 'with()'
        // $newPost = Post::with(["user","category","comments","comments.images"])->find($post->id);

        // SELECCIÓ DEL FORMAT DE LA RESPOSTA
        return response()->json($post);
        // return (new PostResource($post))->additional(['meta' => 'Post mostrat correctament']);
        // return response()->json($newPost);
        // return (new PostResource($newPost))->additional(['meta' => 'Post mostrat correctament']);

    }

    // public function store(Request $request)
    public function store(GuardarPostRequest $request)
    {
        // CREACIÓ DE LES DADES
        $post = Post::create(   // crea un nou post
            [
                'title' => $request->title,
                'url_clean' => $request->url_clean,
                'content' => $request->content,
                'user_id' => $request->user_id,  // Auth::user()->id; (si s'empra la verificació d'usuari)
                'category_id' => $request->category_id,
            ]
        );
        // Post M:N Tags
        foreach ( explode(',', $request->tags) as $tag) 
            $post->tags()->attach(Tag::firstOrCreate(['name' => trim($tag)])->id);  // Tag::where( …)->get()->id       

        // SELECCIÓ DEL FORMAT DE LA RESPOSTA
        // return response()->json(['meta' => 'Post creat correctament']);
        // return response()->json($post);
        // return response()->json([
        return response()->json($post);
        //return new PostResource($post);
    }

    // public function update(PostRequest $request, Post $post)
    public function update(GuardarPostRequest $request, Post $post)
    {
        // MODIFICACIÓ DE LES DADES
        $post->update($request->all());
        
        // SELECCIÓ DEL FORMAT DE LA RESPOSTA
        return (new PostResource($post))->additional(['meta' => 'Post modificat correctament']);
    }

    public function destroy(Post $post)
    {
        // ELIMINACIÓ DE LES DADES
        $post->delete();
                
        // SELECCIÓ DEL FORMAT DE LA RESPOSTA
        return (new PostResource($post))->additional(['msg' => 'Post eliminat correctament']);
    }

    public function prova()    // PER EXEMPLE
    {
        return response()->json(['data' => 'Això és una prova']);
    }
    
}