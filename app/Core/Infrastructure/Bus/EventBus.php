<?php

namespace App\Core\Infrastructure\Bus;

use App\Core\Infrastructure\Interaction\Event\EventInterface;

readonly class EventBus implements EventBusInterface
{
    public function dispatch(EventInterface $event): void
    {
        event($event);
    }
}
