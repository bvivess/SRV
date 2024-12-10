<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('post', PostController::class);
});


/*
Route::middleware('auth')->group(function () {  // middleware('auth') --> 'auth' és el middleware que prové de la instal·lació de 'Breeze'
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/post', PostController::class)->middleware(CheckRoleAdmin::class);
    Route::post('/post/{post}/edit/images',[PostController::class, 'image'])->name('post.image');
    Route::post('/post/{post}/edit/images',[PostController::class, 'image'])->name('post.image');
    Route::resource('/category', CategoryController::class)->middleware(CheckRoleAdmin::class);
});
*/