<?php

namespace App\Core\Infrastructure\Bus;

use App\Core\Infrastructure\Interaction\Event\EventInterface;

interface EventBusInterface
{
    public function dispatch(EventInterface $event): void;
}
