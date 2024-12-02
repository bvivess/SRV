<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Posts;
use App\Models\Comment;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$users = User::all();
        $users = User::with(['posts'])->get();
        //return response()->json($users);
        return (UserResource::collection($users))->additional(['meta' => 'Users mostrats correctament']);  // torna una resposta personalitzada
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //$userx = User::with(['posts.comments','posts.images'])->find($user->id);  // Anida 'comments' dentro de 'posts' y 'images' dentro de 'comments'
        //return response()->json($userx);
        //return new UserResource($userx);

        $user->load('posts')->load('comments')->load('comments.images');
        //return response()->json($user);
        return new UserResource($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
