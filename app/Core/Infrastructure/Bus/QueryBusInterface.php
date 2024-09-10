<?php

namespace App\Core\Infrastructure\Bus;

use App\Core\Infrastructure\Interaction\Query\QueryInterface;
use JeroenG\Autowire\Attribute\Autowire;

#[Autowire]
interface QueryBusInterface
{
    public function dispatch(QueryInterface $query): mixed;
}
