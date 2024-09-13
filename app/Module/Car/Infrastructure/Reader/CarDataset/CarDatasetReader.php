<?php

namespace App\Module\Car\Infrastructure\Reader\CarDataset;

use App\Core\Application\Exception\NotFoundException;
use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\UnavailableStream;

use function Symfony\Component\String\u;

readonly class CarDatasetReader
{
    private const array SELECTED_COLUMNS = [
        'make', 'model', 'type', 'origin', 'driveTrain',
        'engineSize', 'cylinders', 'horsepower', 'weight',
    ];

    public function __construct(
        private string $datasetPath,
    ) {
    }

    /**
     * @throws NotFoundException
     * @throws UnavailableStream
     * @throws Exception
     */
    public function read(): CarCollection
    {
        if (!file_exists($this->datasetPath)) {
            throw new NotFoundException(sprintf('Dataset file `%s` does not exist.', $this->datasetPath));
        }

        $reader = Reader::createFromPath($this->datasetPath);
        $reader->setHeaderOffset(0);
        $collection = new CarCollection();

        foreach ($reader->getRecords() as $record) {
            $row = new CarRow(...$this->transformRecord($record));
            $collection->add($row);
        }

        return $collection;
    }

    /**
     * @param array<string, string> $record
     *
     * @return array<string, string>
     */
    public function transformRecord(array $record): array
    {
        $transformed = [];

        foreach ($record as $key => $value) {
            $key = u($key)->trim()->ascii()->camel()->toString();

            if (in_array($key, self::SELECTED_COLUMNS)) {
                $transformed[$key] = empty($value) ? null : $value;
            }
        }

        return $transformed;
    }
}
