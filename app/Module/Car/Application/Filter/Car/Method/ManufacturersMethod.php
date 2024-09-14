<?php

namespace App\Module\Car\Application\Filter\Car\Method;

use App\Module\Car\Application\Filter\Car\CarFilterMethod;
use App\Module\Car\UI\Dto\CarFilterQueryDto;
use Illuminate\Database\Eloquent\Builder;

class ManufacturersMethod implements CarFilterMethod
{
    public function supports(CarFilterQueryDto $filter): bool
    {
        return !empty($filter->manufacturers);
    }

    public function apply(Builder $queryBuilder, CarFilterQueryDto $filter): void
    {
        $queryBuilder
            ->join('car_manufacturers AS cm', 'c.manufacturer_id', '=', 'cm.id')
            ->whereIn('cm.slug', $filter->manufacturers)
        ;
    }
}
