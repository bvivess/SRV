<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('post', PostController::class);


Route::get('/category', [CategoryController::class, 'index']); // Mostra tots els posts
Route::get('/category/{category}', [CategoryController::class, 'show']); // Mostra un post específic
Route::post('/category', [CategoryController::class, 'store']); // Crea un nou post
Route::put('/category/{category}', [CategoryController::class, 'update']); // Actualitza un post
Route::patch('/category/{category}', [CategoryController::class, 'update']); // Actualitza parcialment un post
Route::delete('/category/{category}', [CategoryController::class, 'destroy']); // Elimina un post

