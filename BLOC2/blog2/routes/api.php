<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::bind('user', function ($value) {
    return is_numeric($value)
        ? User::findOrFail($value) // Cerca per 'id'
        : User::where('email', $value)->firstOrFail(); // Cerca per 'email'
});

Route::apiResource('user', UserController::class);

Route::get('/user/find/{value}', [UserController::class, 'find']); // Més específica, ha d'anar abans
// Route::apiresource('user', UserController::class)->except('show'); // si cal exceptuar algun mètode

Route::get('user/findbyid/{id}', [UserController::class, 'findById']);
Route::get('user/findbyemail/{email}', [UserController::class, 'findByEmail']);


Route::get('/post/{title}', [PostController::class, 'show']);

Route::apiResource('post', PostController::class)->except(['show']);


Route::get('/category', [CategoryController::class, 'index']); // Mostra tots els posts
Route::get('/category/{category}', [CategoryController::class, 'show']); // Mostra un post específic
Route::post('/category', [CategoryController::class, 'store']); // Crea un nou post
Route::put('/category/{category}', [CategoryController::class, 'update']); // Actualitza un post
Route::patch('/category/{category}', [CategoryController::class, 'update']); // Actualitza parcialment un post
Route::delete('/category/{category}', [CategoryController::class, 'destroy']); // Elimina un post

