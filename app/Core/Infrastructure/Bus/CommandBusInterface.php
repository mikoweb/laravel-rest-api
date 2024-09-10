<?php

namespace App\Core\Infrastructure\Bus;

use App\Core\Infrastructure\Interaction\Command\CommandInterface;
use JeroenG\Autowire\Attribute\Autowire;

#[Autowire]
interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): mixed;
}
