<?php

use App\Core\Application\Utils\PathUtils;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: array_filter([
            ...array_map(fn (string $path) => $path . '/Infrastructure/routes/web.php', PathUtils::getModulesPaths()),
            __DIR__ . '/../app/Shared/Infrastructure/routes/web.php',
            __DIR__ . '/../routes/web.php',
        ], fn (string $path) => file_exists($path)),
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
    })
    ->withExceptions(function (Exceptions $exceptions) {
    })
    ->withEvents(discover: [
        ...array_map(fn (string $path) => $path . '/Application/Interaction', PathUtils::getModulesPaths()),
        __DIR__ . '/../app/Shared/Application/Interaction',
    ])
    ->create();
