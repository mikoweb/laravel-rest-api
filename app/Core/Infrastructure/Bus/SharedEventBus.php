<?php

namespace App\Core\Infrastructure\Bus;

use App\Core\Infrastructure\Interaction\SharedEvent\SharedEventInterface;

readonly class SharedEventBus implements SharedEventBusInterface
{
    public function dispatch(SharedEventInterface $event): void
    {
        event($event);
    }
}
