<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Exceptions\RegisterErrorViewPaths;
use Throwable;

// Determine environment using raw PHP to avoid container calls during bootstrap
$isProduction = ($_ENV['APP_ENV'] ?? $_SERVER['APP_ENV'] ?? 'production') === 'production';

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) use ($isProduction): void {
        $exceptions->render(function (Throwable $e) use ($isProduction) {
            if ($isProduction) {
                return response('Server Error', 500);
            }
        });
    })->create();

if ($isProduction) {
    $app->bind(RegisterErrorViewPaths::class, function () {
        return new class {
            public function __invoke() {
                // Intentionally empty — disables error view registration
            }
        };
    });
}

return $app;