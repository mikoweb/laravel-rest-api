<?php

namespace App\Module\Car\Application\Filter\Car;

use App\Module\Car\UI\Dto\CarFilterQueryDto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface CarFilterMethod
{
    public function supports(CarFilterQueryDto $filter): bool;

    /**
     * @param Builder<Model> $queryBuilder
     */
    public function apply(Builder $queryBuilder, CarFilterQueryDto $filter): void;
}
