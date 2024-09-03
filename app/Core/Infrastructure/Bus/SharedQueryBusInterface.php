<?php

namespace App\Core\Infrastructure\Bus;

use App\Core\Infrastructure\Interaction\SharedQuery\SharedQueryInterface;

interface SharedQueryBusInterface
{
    public function dispatch(SharedQueryInterface $query): mixed;
}
