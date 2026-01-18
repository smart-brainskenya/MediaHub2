<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Exceptions\RegisterErrorViewPaths;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

// Determine environment using raw PHP to avoid container calls during bootstrap
$isProduction = ($_ENV['APP_ENV'] ?? $_SERVER['APP_ENV'] ?? 'production') === 'production';

// Ensure writable /tmp paths exist if configured
if ($isProduction) {
    if ($viewPath = ($_ENV['VIEW_COMPILED_PATH'] ?? null)) {
        if (!is_dir($viewPath)) mkdir($viewPath, 0755, true);
    }
    if ($cachePath = ($_ENV['CACHE_PATH'] ?? null)) {
        if (!is_dir($cachePath)) mkdir($cachePath, 0755, true);
    }
}

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
                // Return a raw Symfony response to avoid resolving the Laravel ResponseFactory or View services
                return new Response(
                    'Server Error',
                    500,
                    ['Content-Type' => 'text/plain']
                );
            }
        });
    })->create();

// Neutralize RegisterErrorViewPaths during bootstrap to prevent early View service resolution
$app->resolving(RegisterErrorViewPaths::class, function ($service) use ($isProduction) {
    if ($isProduction) {
        // Prevent Laravel from attempting to load error Blade views
        $service->paths = [];
    }
});

return $app;