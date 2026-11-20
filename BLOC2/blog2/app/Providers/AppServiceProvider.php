<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
=======
>>>>>>> cc6c34e27980f064f485069f49a0f67c773daef4

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
<<<<<<< HEAD
        // En mode de producció, activar la protecció d'assignació massiva
        Model::shouldBeStrict();
=======
        //
>>>>>>> cc6c34e27980f064f485069f49a0f67c773daef4
    }
}
