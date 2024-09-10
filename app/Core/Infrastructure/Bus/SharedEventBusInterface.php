<?php

namespace App\Core\Infrastructure\Bus;

use App\Core\Infrastructure\Interaction\SharedEvent\SharedEventInterface;
use JeroenG\Autowire\Attribute\Autowire;

#[Autowire]
interface SharedEventBusInterface
{
    public function dispatch(SharedEventInterface $event): void;
}
