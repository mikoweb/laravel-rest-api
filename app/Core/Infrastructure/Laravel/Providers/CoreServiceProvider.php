<?php

namespace App\Core\Infrastructure\Laravel\Providers;

use App\Core\Infrastructure\Bus\CommandBus;
use App\Core\Infrastructure\Bus\CommandBusInterface;
use App\Core\Infrastructure\Bus\EventBus;
use App\Core\Infrastructure\Bus\EventBusInterface;
use App\Core\Infrastructure\Bus\QueryBus;
use App\Core\Infrastructure\Bus\QueryBusInterface;
use App\Core\Infrastructure\Bus\SharedEventBus;
use App\Core\Infrastructure\Bus\SharedEventBusInterface;
use App\Core\Infrastructure\Bus\SharedQueryBus;
use App\Core\Infrastructure\Bus\SharedQueryBusInterface;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CommandBusInterface::class, CommandBus::class);
        $this->app->singleton(EventBusInterface::class, EventBus::class);
        $this->app->singleton(QueryBusInterface::class, QueryBus::class);
        $this->app->singleton(SharedEventBusInterface::class, SharedEventBus::class);
        $this->app->singleton(SharedQueryBusInterface::class, SharedQueryBus::class);
    }
}
