<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Registrar middleware personalitzat
        $middleware->alias([
            //'CheckRoleAdmin' => \App\Http\Middleware\CheckRoleAdmin::class,
            'multi_auth' => \App\Http\Middleware\MultiAuthMiddleware::class,
            'ApiKeyMiddleware' => \App\Http\Middleware\ApiKeyMiddleware::class,
        ]);

        // Aplicar middleware específic per a API
        $middleware->api("throttle:api");
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Manejar excepcions per a rutes API
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'No hem trobat elements.'
                ], 404);
            }
        });
    })
    ->create();
