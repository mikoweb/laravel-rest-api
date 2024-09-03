<?php

namespace App\Core\Infrastructure\Bus;

use App\Core\Infrastructure\Interaction\Query\QueryInterface;

readonly class QueryBus implements QueryBusInterface
{
    public function dispatch(QueryInterface $query): mixed
    {
        $result = event($query);

        return is_array($result) && count($result) > 0 ? $result[0] : null;
    }
}
