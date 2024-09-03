<?php

namespace App\Core\Infrastructure\Bus;

use App\Core\Infrastructure\Interaction\Query\QueryInterface;

interface QueryBusInterface
{
    public function dispatch(QueryInterface $query): mixed;
}
