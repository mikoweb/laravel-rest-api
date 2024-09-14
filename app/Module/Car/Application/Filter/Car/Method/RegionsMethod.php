<?php

namespace App\Module\Car\Application\Filter\Car\Method;

use App\Module\Car\Application\Filter\Car\CarFilterMethod;
use App\Module\Car\UI\Dto\CarFilterQueryDto;
use Illuminate\Database\Eloquent\Builder;

class RegionsMethod implements CarFilterMethod
{
    public function supports(CarFilterQueryDto $filter): bool
    {
        return !empty($filter->regions);
    }

    public function apply(Builder $queryBuilder, CarFilterQueryDto $filter): void
    {
        $queryBuilder
            ->join('car_regions AS cr', 'c.region_id', '=', 'cr.id')
            ->whereIn('cr.slug', $filter->regions)
        ;
    }
}
