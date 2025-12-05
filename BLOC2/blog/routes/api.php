<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Models\User;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Cerca per 'binding ajustat'
Route::bind('user', function ($value) {
    return is_numeric($value)
        ? User::findOrFail($value) // Cerca per 'id'
        : User::where('email', $value)->firstOrFail(); // Cerca per 'email'
});

Route::apiResource('user', UserController::class); // contempla tots els mètodes a l'hora

// Cerca per 'agrupació de rutes'
Route::apiResource('category', CategoryController::class); // contempla tots els mètodes a l'hora
Route::get('category/search/{value}', [CategoryController::class, 'search']);

// Cerca per 'Rutes separades'
Route::get('category/findById/{id}', [CategoryController::class, 'findById']);
Route::get('category/findByTitle/{value}', [CategoryController::class, 'findByTitle']);


Route::get('/post', [PostController::class, 'index']); // Mostra tots els posts
Route::post('/post', [PostController::class, 'store']); // Crea un nou post
Route::get('/post/{post}', [PostController::class, 'show']); // Mostra un post específic
Route::put('/post/{post}', [PostController::class, 'update']); // Actualitza un post
Route::patch('/post/{post}', [PostController::class, 'update']); // Actualitza parcialment un post
Route::delete('/post/{post}', [PostController::class, 'destroy']); // Elimina un post
