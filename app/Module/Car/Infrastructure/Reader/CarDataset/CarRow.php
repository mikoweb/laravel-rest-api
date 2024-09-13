<?php

namespace App\Module\Car\Infrastructure\Reader\CarDataset;

readonly class CarRow
{
    public function __construct(
        public string $make,
        public string $model,
        public string $type,
        public string $origin,
        public string $driveTrain,
        public float $engineSize,
        public ?int $cylinders,
        public int $horsepower,
        public int $weight,
    ) {
    }
}
