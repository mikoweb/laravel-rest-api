<?php

namespace App\Module\Car\UI\CLI;

use App\Core\Application\Utils\PathUtils;
use App\Core\Infrastructure\Bus\CommandBusInterface;
use App\Module\Car\Application\Interaction\Command\ImportCarsFromCsv\ImportCarsFromCsvCommand;
use Illuminate\Console\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportCarsFromCsvCli extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:car:import-cars-from-csv';

    public function handle(CommandBusInterface $commandBus): void
    {
        $io = new SymfonyStyle($this->input, $this->output);

        $commandBus->dispatch(new ImportCarsFromCsvCommand(PathUtils::getDatasetPath('cars.csv')));

        $io->success('The cars were imported!');
    }
}
