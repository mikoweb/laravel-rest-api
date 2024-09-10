<?php

namespace App\Core\Infrastructure\Bus;

use App\Core\Infrastructure\Interaction\SharedQuery\SharedQueryInterface;
use JeroenG\Autowire\Attribute\Autowire;

#[Autowire]
interface SharedQueryBusInterface
{
    public function dispatch(SharedQueryInterface $query): mixed;
}
