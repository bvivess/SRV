<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;


Route::get('/user', function (Request $request) {
    return $request->user();
});

/*
Route::bind('post', function ($value) {
    return is_numeric($value)
        ? Post::findOrFail($value) // Cerca pel camp `id`
        : Post::where('title', $value)->firstOrFail(); // Cerca pel camp `title`
});
Route::apiResource('/post', PostController::class);  // Les tracta totes
*/
// Route::get('/post', [PostController::class, 'index']); // Mostrar tots els posts
// Route::get('/post/{post}', [PostController::class, 'show']); // Mostrar un post específic
// Route::post('/post', [PostController::class, 'store']); // Crear un nou post
// Route::put('/post/{post}', [PostController::class, 'update']); // Actualitzar un post
// Route::patch('/post/{post}', [PostController::class, 'update']); // Actualitzar parcialment un post
// Route::delete('/post/{post}', [PostController::class, 'destroy']); // Eliminar un post
Route::get('/prova', [PostController::class, 'prova']);  // PER EXEMPLE

Route::apiResource('/category', CategoryController::class);  // Les tracta totes
Route::apiResource('/user', UserController::class);  // Les tracta totes

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/*
Route::middleware(['auth:sanctum'])->group(function () {  // middleware('auth:sanctum'') 
    // Noves rutes
    Route::bind('post', function ($value) {
        return is_numeric($value)
            ? Post::findOrFail($value) // Cerca pel camp `id`
            : Post::where('title', $value)->firstOrFail(); // Cerca pel camp `title`
    });
    Route::apiResource('/post', PostController::class);  // Les tracta totes

    //Route::apiResource('/post', PostController::class);  // Les tracta totes
    //Route::apiResource('/category', CategoryController::class);  // Les tracta totes
    //Route::apiResource('/user', UserController::class);  // Les tracta totes

    Route::post('/logout', [AuthController::class, 'logout']);
}); */


Route::middleware(['ApiKeyMiddleware'])->group(function () {
    Route::get('/protected-route', function () {
        return response()->json(['message' => 'Aquesta ruta està protegida per API Key']);
    });

    Route::apiResource('/post', PostController::class);  // Les tracta totes
});



