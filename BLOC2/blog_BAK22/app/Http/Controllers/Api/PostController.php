<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        // $posts = Post::paginate(3);  // crea una sortida amb paginació
        // $posts = Post::with([])->get();  // no té sentit
        // $posts = Post::with(["user", "category", "comments"])->get();  // post amb les taules relacionades, més óptima
        // $posts = Post::with(["user", "category", "comments", "comments.images"])->get();
        // $posts = Post::with(["user", "category", "comments", "comments.images"])->paginate(3);  // post amb les taules relacionades, paginada
        
        return response()->json($posts);  // --> torna una resposta serialitzada en format 'json'
        // return (PostResource::collection($posts))->additional(['meta' => 'Posts mostrats correctament']);  // torna una resposta personalitzada
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // amb 'with()'
        // $newPost = Post::with(["user","category","comments","comments.images"])->find($post->id);
        // return response()->json($newPost);
        // return (new PostResource($newPost))->additional(['meta' => 'Post mostrat correctament']);

        // amb 'load()'
        $post->load('user')->load('category')->load('comments')->load('comments.images');
        return response()->json($post);
        // return (new PostResource($post))->additional(['meta' => 'Post mostrat correctament']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$data = $request->all();
                                                       // Auth::user()->id; (si s'empra la verificació d'usuari)
        $post = Post::create(   // crea un nou post
            [
                'title' => $request->title,
                'content' => $request->content,
                'url_clean' => $request->url_clean,
                'user_id' => 1,
                'category_id' => $request->category_id,
            ]
        );

        foreach ( explode(',', $request->tags) as $tag) 
            $post->tags()->attach(Tag::firstOrCreate(['name' => trim($tag)])->id);         


        return response()->json(['meta' => 'Post creat correctament']);
        // return response()->json($post);
        // return response()->json([
        // return response()->json($post);
        //return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
