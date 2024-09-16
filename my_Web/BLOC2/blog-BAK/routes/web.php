<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Users;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});




Route::resource('/posts', PostController::class);






Route::get('/hola', function ($nom, $professio = null) {
    return 'Hola mon';
});


Route::get('/hola/{nom}/{professio?}', function ($nom, $professio = null) {
    return 'Hola '.$nom." Professió ".$professio;
})->whereAlpha('nom')->name('salutacio');

Route::get('/perfil/{nom}', function ($nom) {
    return view('profile', ['nom' => $nom]);
})->name('perfil');

Route::get('/perfil/{id}', function ($id) {
  return "PERFIL Nº <a href='".route('salutacio', ['nom' => 'Jaume'])."' >salutació</a> ".$id;  
});

Route::get('/perfil/{id}', function ($id) {
    return 'Perfil ' . $id;
});


Route::group(['prefix'=>'admin'], function() {
    Route::get('/hola/{nom}', function ($nom) {
    })->name('salutacio');
    Route::get('/usuari/{nom}', function ($nom) {
    })->name('user');
});

Route::get('users/{user}', function (App\Models\User $user) {
    return $user;
});

Route::get('posts/{post}', function (App\Models\Post $post) {
    return $post->url_clean;
});


//Cridada a un controlador amb laravel 11
//Route::get('/posts', [PostController::class, 'index']);




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
