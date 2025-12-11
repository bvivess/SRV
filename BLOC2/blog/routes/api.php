<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Models\User;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// RUTES PROTEGIDES PER MÚLTIPLES MÈTODES D'AUTENTICACIÓ
Route::middleware('MULTI-AUTH')->group(function () {  // Protegit per 'auth:sanctum' i per 'api-key'
// Route::middleware('auth:sanctum')->group(function () {  // Protegit per 'auth:sanctum'
// Route::middleware('API-KEY')->group(function () {  // Protegit per 'api-key'
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

    // RUTES 'category'
    // Cerca per 'agrupació de rutes'
    Route::get('category/find/{value}', [CategoryController::class, 'find']);
    Route::apiResource('category', CategoryController::class); // contempla tots els mètodes a l'hora

    // Cerca per 'Rutes separades'
    Route::get('category/findById/{id}', [CategoryController::class, 'findById']);
    Route::get('category/findByTitle/{value}', [CategoryController::class, 'findByTitle']);

    // RUTES 'post'
    Route::get('post/find/{value}', [PostController::class, 'find']);
    Route::get('post', [PostController::class, 'index']); // Mostra tots els posts
    Route::post('post', [PostController::class, 'store']); // Crea un nou post
    Route::get('post/{post}', [PostController::class, 'show']); // Mostra un post específic
    Route::put('post/{post}', [PostController::class, 'update']); // Actualitza un post
    Route::patch('post/{post}', [PostController::class, 'update']); // Actualitza parcialment un post
    Route::delete('post/{post}', [PostController::class, 'destroy']); // Elimina un post

    // Route::apiResource('user', UserController::class)->middleware('CheckRoleAdmin'); // contempla tots els mètodes a l'hora
    // RUTES 'user'
    // Cerca per 'binding ajustat'
    Route::bind('user', function ($value) {
        return is_numeric($value)
        ? User::findOrFail($value) // Cerca per 'id'
        : User::where('email', $value)->firstOrFail(); // Cerca per 'email'
    });
    Route::apiResource('user', UserController::class)->only('show');
    // RUTES PROTEGIDES NOMÉS PER 'ADMIN'
    Route::middleware('CHECK-ROLEADMIN')->group(function () {
        Route::apiResource('user', UserController::class)->except('show');
    });

});


