<?php

namespace App\Core\Infrastructure\Bus;

use App\Core\Infrastructure\Interaction\Command\CommandInterface;

readonly class CommandBus implements CommandBusInterface
{
    public function dispatch(CommandInterface $command): mixed
    {
        $result = event($command);

        return is_array($result) && count($result) > 0 ? $result[0] : null;
    }
}
