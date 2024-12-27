<?php

use App\Models\User;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SpaceController;

// Noves rutes
Route::bind('space', function ($value) {
    return is_numeric($value)
        ? Space::findOrFail($value) // Cerca pel camp 'id'
        : Space::where('regNumber', $value)->firstOrFail(); // Cerca pel camp 'regNumber'
});
Route::bind('user', function ($value) {
    return is_numeric($value)
        ? User::findOrFail($value) // Cerca pel camp 'id'
        : User::where('email', $value)->firstOrFail(); // Cerca pel camp 'email'
});

// Rutes sense autenticació
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['multi_auth'])->group(function () {
    Route::get('/space', [SpaceController::class, 'index']);
    Route::get('/space/{space}', [SpaceController::class, 'show']);
    Route::post('/space', [SpaceController::class, 'store']);
    Route::get('/user/{user}', [UserController::class, 'show']);
    Route::put('/user/{user}', [UserController::class, 'update']);
    Route::delete('/user/{user}', [UserController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

/*
// Rutes amb autenticació per API Key
Route::middleware(['ApiKeyMiddleware'])->group(function () {
    //Route::apiResource('/space', SpaceController::class);
    Route::get('/space', [SpaceController::class, 'index']);
    Route::get('/space/{space}', [SpaceController::class, 'show']);
    Route::post('/space', [SpaceController::class, 'store']);
    Route::get('/user/{user}', [UserController::class, 'show']);
    Route::put('/user/{user}', [UserController::class, 'update']);
    Route::delete('/user/{user}', [UserController::class, 'destroy']);
});

// Rutes amb autenticació per Sanctum
Route::middleware(['auth:sanctum'])->group(function () {  // middleware('auth:sanctum'') 
    //Route::apiResource('/space', SpaceController::class);
    Route::get('/space', [SpaceController::class, 'index']);
    Route::get('/space/{space}', [SpaceController::class, 'show']);
    Route::post('/space', [SpaceController::class, 'store']);
    Route::get('/user/{user}', [UserController::class, 'show']);
    Route::put('/user/{user}', [UserController::class, 'update']);
    Route::delete('/user/{user}', [UserController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
*/

