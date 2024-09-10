<?php

namespace App\Core\Infrastructure\Bus;

use App\Core\Infrastructure\Interaction\Event\EventInterface;
use JeroenG\Autowire\Attribute\Autowire;

#[Autowire]
interface EventBusInterface
{
    public function dispatch(EventInterface $event): void;
}
