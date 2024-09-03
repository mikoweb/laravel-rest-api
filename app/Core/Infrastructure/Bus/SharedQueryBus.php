<?php

namespace App\Core\Infrastructure\Bus;

use App\Core\Infrastructure\Interaction\SharedQuery\SharedQueryInterface;

readonly class SharedQueryBus implements SharedQueryBusInterface
{
    public function dispatch(SharedQueryInterface $query): mixed
    {
        $result = event($query);

        return is_array($result) && count($result) > 0 ? $result[0] : null;
    }
}
