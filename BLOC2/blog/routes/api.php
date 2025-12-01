<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('category', CategoryController::class); // contempla tots els mètodes a l'hora

Route::get('/post', [PostController::class, 'index']); // Mostra tots els posts
Route::post('/post', [PostController::class, 'store']); // Crea un nou post
Route::get('/post/{post}', [PostController::class, 'show']); // Mostra un post específic
Route::put('/post/{post}', [PostController::class, 'update']); // Actualitza un post
Route::patch('/post/{post}', [PostController::class, 'update']); // Actualitza parcialment un post
Route::delete('/post/{post}', [PostController::class, 'destroy']); // Elimina un post
