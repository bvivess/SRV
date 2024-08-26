<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// ruta normal
Route::get('/', function () {
    return view('welcome');
});

// ruta a una 'uri'
Route::get('/post', function () {
    return "Es mostra un post concret";
});



// ruta amb paràmetres opcionals i amb condicions
Route::get('/post/{post}/{category?}', function ($post, $category=null) {
    return "Es mostra el post " . " " .$post . " de la categoria " . $category;
})->where('category', '[A-Za-z]+'); // equivalent a "->whereAlpha('category')"

// ruta amb paràmetres
Route::get('/post/{post}', function ($post) {
    return "Es mostra el post " . " " .$post;
});

// ruta amb 'nom'
Route::get('/post/{post}}', function ($post) {
    return "Es mostra el post " . " " .$post;
})->where('post', '[A-Za-z]+')->name('post.profile');  
               // <a href="{{ route('post.profile', ['post' => 'laravel']) }}">Post Profile</a>
               // http://.../post/laravel
               // return redirect()->route('post.profile', ['post' => 'laravel']);