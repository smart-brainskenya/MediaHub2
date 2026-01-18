<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Exceptions\RegisterErrorViewPaths;
use Throwable;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e) {
            if (app()->environment('production')) {
                return response('Server Error', 500);
            }
        });
    })->create();

if ($app->environment('production')) {
    $app->bind(RegisterErrorViewPaths::class, function () {
        return new class {
            public function __invoke() {
                // Intentionally empty — disables error view registration
            }
        };
    });
}

return $app;
