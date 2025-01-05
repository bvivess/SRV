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
    Route::apiresource('/space', SpaceController::class)->only(['index','show','store']);

    Route::apiresource('/user', SpaceController::class)->only(['show','update','destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});