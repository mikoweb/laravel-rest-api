<?php

namespace App\Module\Car\Application\Interaction\Command\ImportCarsFromCsv\Handler;

use App\Module\Car\Application\Import\CarDatasetImporter;
use App\Module\Car\Application\Interaction\Command\ImportCarsFromCsv\ImportCarsFromCsvCommand;

readonly class ImportCarsFromCsvHandler
{
    public function __construct(
        private CarDatasetImporter $carDatasetImporter,
    ) {
    }

    public function handle(ImportCarsFromCsvCommand $command): void
    {
        $this->carDatasetImporter->import($command->datasetPath);
    }
}
