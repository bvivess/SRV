<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with(["posts", "comments","posts","comments.images"])->get(); 
        return UserResource::collection($users)->additional(['meta' => 'Usuari mostrat correctament']);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load('posts')->load('comments')->load('posts')->load('comments.images'); 
        return (new UserResource($user))->additional(['meta' => 'Usuari mostrat correctament']);
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
