<?php

namespace App\Core\Infrastructure\Bus;

use App\Core\Infrastructure\Interaction\Command\CommandInterface;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): mixed;
}
