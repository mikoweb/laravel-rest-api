<?php

namespace App\Shared\Application\Interaction\SharedQuery\Car;

use App\Core\Infrastructure\Interaction\SharedQuery\SharedQueryInterface;

readonly class AskForCarSharedQuery implements SharedQueryInterface
{
    public function __construct(
        public string $id,
    ) {
    }
}
