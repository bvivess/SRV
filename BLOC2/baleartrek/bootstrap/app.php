<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(   // Rutes presents a 'web.php' i 'api.php'
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
            'CHECK-ROLEADMIN' => \App\Http\Middleware\CheckRoleAdmin::class,  // 'CHECK-ROLEADMIN' és l'alias del middleware
            'API-KEY' => \App\Http\Middleware\ApiKeyMiddleware::class,  // 'API-KEY' és l'alias del middleware
            'MULTI-AUTH' => \App\Http\Middleware\MultiAuthMiddleware::class,  // 'MULTI-AUTH' és l'alias del middleware
        ]);

        // Aplicar middleware específic per a API: "app/Providers/RouteServiceProvider.php"
        $middleware->api("throttle:api");  // aplica "rate limiting"
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
