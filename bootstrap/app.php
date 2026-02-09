<?php

use App\Http\Middleware\DocumentacionCompletaMiddleware;
use Illuminate\Foundation\Application;
use App\Http\Middleware\EstaActivoMiddleware;
use App\Http\Middleware\RefrendoActivoMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        apiPrefix: 'api/v1',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->alias([
            'esta.activo' => EstaActivoMiddleware::class,
            'role'=> RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'documentacion_completa' => DocumentacionCompletaMiddleware::class,
            'refrendo_activo' => RefrendoActivoMiddleware::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
