<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Models\User;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Cerca per 'binding ajustat'
Route::bind('user', function ($value) {
    return is_numeric($value)
        ? User::findOrFail($value) // Cerca per 'id'
        : User::where('email', $value)->firstOrFail(); // Cerca per 'email'
});

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Protegida pel middleware 'auth:sanctum'
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

    // Cerca per 'agrupació de rutes'
    Route::get('category/find/{value}', [CategoryController::class, 'find']);
    Route::apiResource('category', CategoryController::class); // contempla tots els mètodes a l'hora


    // Cerca per 'Rutes separades'
    Route::get('category/findById/{id}', [CategoryController::class, 'findById']);
    Route::get('category/findByTitle/{value}', [CategoryController::class, 'findByTitle']);
});

Route::apiResource('user', UserController::class); // contempla tots els mètodes a l'hora

Route::get('post/find/{value}', [PostController::class, 'find']);
Route::get('post', [PostController::class, 'index']); // Mostra tots els posts
Route::post('post', [PostController::class, 'store']); // Crea un nou post
Route::get('post/{post}', [PostController::class, 'show']); // Mostra un post específic
Route::put('post/{post}', [PostController::class, 'update']); // Actualitza un post
Route::patch('post/{post}', [PostController::class, 'update']); // Actualitza parcialment un post
Route::delete('post/{post}', [PostController::class, 'destroy']); // Elimina un post
