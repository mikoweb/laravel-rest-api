<?php

namespace App\Module\Car\Application\Interaction\Command\ImportCarsFromCsv;

use App\Core\Infrastructure\Interaction\Command\CommandInterface;

readonly class ImportCarsFromCsvCommand implements CommandInterface
{
    public function __construct(
        public string $datasetPath,
    ) {
    }
}
