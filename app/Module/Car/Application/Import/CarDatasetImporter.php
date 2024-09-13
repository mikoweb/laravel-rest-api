<?php

namespace App\Module\Car\Application\Import;

use App\Module\Car\Domain\Model\Car;
use App\Module\Car\Domain\Model\CarManufacturer;
use App\Module\Car\Domain\Model\CarRegion;
use App\Module\Car\Domain\Model\CarType;
use App\Module\Car\Infrastructure\Reader\CarDataset\CarDatasetReader;
use App\Module\Car\Infrastructure\Reader\CarDataset\CarRow;
use App\Module\Car\Infrastructure\Repository\CarRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Collection\Map\TypedMap;
use Throwable;

readonly class CarDatasetImporter
{
    public function __construct(
        private CarRepository $carRepository,
    ) {
    }

    public function import(string $datasetPath): void
    {
        $reader = new CarDatasetReader($datasetPath);
        $dataset = $reader->read();

        /** @var TypedMap<string, CarManufacturer> $manufacturers */
        $manufacturers = $this->createDictMap(
            array_unique($dataset->column('make')),
            CarManufacturer::class,
        );

        /** @var TypedMap<string, CarType> $types */
        $types = $this->createDictMap(
            array_unique($dataset->column('type')),
            CarType::class,
        );

        /** @var TypedMap<string, CarRegion> $regions */
        $regions = $this->createDictMap(
            array_unique($dataset->column('origin')),
            CarRegion::class,
        );

        DB::beginTransaction();

        try {
            $this->saveModels($manufacturers);
            $this->saveModels($types);
            $this->saveModels($regions);
            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }

        DB::beginTransaction();

        try {
            foreach ($dataset as $row) {
                $this->saveCarRow($row, $manufacturers, $types, $regions);
            }

            DB::commit();
        } catch (Throwable $exception) {
            throw $exception;
        }
    }

    /**
     * @param array<string> $values
     *
     * @return TypedMap<string, object>
     */
    private function createDictMap(array $values, string $typeClass): TypedMap
    {
        $map = new TypedMap('string', $typeClass);

        foreach ($values as $value) {
            $model = $typeClass::where('name', $value)->first() ?? new $typeClass();
            $model->setName($value);

            $map->put($value, $model);
        }

        return $map;
    }

    /**
     * @param iterable<Model> $models
     */
    private function saveModels(iterable $models): void
    {
        foreach ($models as $model) {
            $model->save();
        }
    }

    /**
     * @param TypedMap<string, CarManufacturer> $manufacturers
     * @param TypedMap<string, CarType>         $types
     * @param TypedMap<string, CarRegion>       $regions
     */
    private function saveCarRow(
        CarRow $row,
        TypedMap $manufacturers,
        TypedMap $types,
        TypedMap $regions,
    ): void {
        $name = "{$row->make} {$row->model}";
        $car = $this->carRepository->findByField('name', $name)->first() ?? new Car();

        $car->setAllValues(
            name: $name,
            model: $row->model,
            driveTrain: $row->driveTrain,
            engineSize: $row->engineSize,
            cylinders: $row->cylinders,
            horsepower: $row->horsepower,
            weight: $row->weight,
            manufacturer: $manufacturers->get($row->make),
            type: $types->get($row->type),
            region: $regions->get($row->origin),
        );

        $car->save();
    }
}
