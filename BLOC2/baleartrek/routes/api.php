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

// Protegida pel middleware 'auth:sanctum'
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

    Route::get('/trek/find/{value}', [TrekController::class, 'find']); // Més específica, ha d'anar abans
    Route::apiresource('trek', TrekController::class)->except('show'); // si cal exceptuar algun mètode
});



    // Binding de 'user' (ha d'estar abans de les rutes que l'utilitzen)
    Route::bind('user', function ($value) {
        return is_numeric($value)
            ? User::where('id', $value)->firstOrFail()
            : User::where('dni', $value)->firstOrFail();
    });

    // Rutes d'usuaris
    Route::apiResource('user', UserController::class);