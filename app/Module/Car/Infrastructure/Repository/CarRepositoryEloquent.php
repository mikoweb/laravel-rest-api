<?php

namespace App\Module\Car\Infrastructure\Repository;

use App\Core\Infrastructure\Eloquent\BaseRepository;
use App\Module\Car\Domain\Model\Car;

class CarRepositoryEloquent extends BaseRepository implements CarRepository
{
    public function model(): string
    {
        return Car::class;
    }
}
