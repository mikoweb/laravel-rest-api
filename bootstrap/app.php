<?php

use App\Core\Application\Utils\PathUtils;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: PathUtils::getRoutesPaths('web'),
        api: PathUtils::getRoutesPaths('api'),
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        // apiPrefix: 'api',
    )
    ->withMiddleware(function (Middleware $middleware) {
    })
    ->withExceptions(function (Exceptions $exceptions) {
    })
    ->withEvents(discover: [
        ...array_map(fn (string $path) => $path . '/Application/Interaction', PathUtils::getModulesPaths()),
        __DIR__ . '/../app/Shared/Application/Interaction',
    ])
    ->withCommands([
        ...array_map(fn (string $path) => $path . '/UI/CLI', PathUtils::getModulesPaths()),
        __DIR__ . '/../app/Shared/UI/CLI',
    ])
    ->create();
