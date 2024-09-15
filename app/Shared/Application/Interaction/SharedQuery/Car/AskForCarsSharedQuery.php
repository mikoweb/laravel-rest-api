<?php

namespace App\Shared\Application\Interaction\SharedQuery\Car;

use App\Core\Infrastructure\Interaction\SharedQuery\SharedQueryInterface;

readonly class AskForCarsSharedQuery implements SharedQueryInterface
{
    public function __construct(
        /**
         * @var string[]
         */
        public array $ids,
    ) {
    }
}
