<?php

use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\CheckAbilities;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->web(append: [ApiAuthMiddleware::class]);
        $middleware->alias([
            'abilities' => CheckAbilities::class,
        ]);
        $middleware->trustHosts(at: ['laravel.test'], subdomains: false);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
