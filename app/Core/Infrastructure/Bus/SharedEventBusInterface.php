<?php

namespace App\Core\Infrastructure\Bus;

use App\Core\Infrastructure\Interaction\SharedEvent\SharedEventInterface;

interface SharedEventBusInterface
{
    public function dispatch(SharedEventInterface $event): void;
}
