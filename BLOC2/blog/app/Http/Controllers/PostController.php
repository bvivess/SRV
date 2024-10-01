<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\GuardarPostRequest;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(["user" , "image" ])->paginate(4);
        return view('post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::pluck('id', 'title');

        return view('post.create', ['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuardarPostRequest $request)
    {
    
        $post = new Post;
        $post->title = $request->title;
        $post->url_clean = $request->url_clean;
        $post->content = $request->content;
        $post->category_id = $request->categories_id;
        $post->posted = $request->posted;
        $post->user_id = 1; // Auth::user()->id;
        $post->save();

        return back()->with('status', '<h1>Creació categoria OK</h1>');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }

    public function image(Request $request, Post $post){
        $request->validate([
          'name' => 'required|max:10240',
        ]);
      
        $filename = time().".".$request->name->extension();
        $request->name->move(public_path('images'), $filename);
        PostImage::create(['name' => $filename, 'post_id' => $post->id]);

        return redirect('post')->with('status', 'Càrrega imatge OK');
    }

}