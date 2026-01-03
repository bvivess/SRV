<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Trek;
use App\Models\User;
use App\Http\Controllers\Api\TrekController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// RUTES PROTEGIDES PER MÚLTIPLES MÈTODES D'AUTENTICACIÓ
Route::middleware('MULTI-AUTH')->group(function () {  // Protegit per 'auth:sanctum' i per 'api-key'
// Route::middleware('auth:sanctum')->group(function () {  // Protegit per 'auth:sanctum'
// Route::middleware('API-KEY')->group(function () {  // Protegit per 'api-key'
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

    // Binding de 'user' (ha d'estar abans de les rutes que l'utilitzen)
    Route::bind('user', function ($value) {
        return is_numeric($value)
            ? User::where('id', $value)->firstOrFail()
            : User::where('dni', $value)->firstOrFail();
    });

    // Rutes 'user'
    Route::apiResource('user', UserController::class)->except('index');  // Totes menys 'index'
    Route::middleware('CHECK-ROLEADMIN')->group(function () {
        Route::apiResource('user', UserController::class)->only('index');  // Només admin pot veure tots els usuaris
    });

    // Rutes 'trek'
    Route::get('/trek/find/{value}', [TrekController::class, 'find']);  // 'find' substitueix 'show'
    Route::apiResource('trek', TrekController::class)->except('show');  // 'except' perquè 'show' està substituït per 'find'
});




