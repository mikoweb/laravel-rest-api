<?php

namespace App\Module\Car\Application\Filter\Car\Method;

use App\Module\Car\Application\Filter\Car\CarFilterMethod;
use App\Module\Car\UI\Dto\CarFilterQueryDto;
use Illuminate\Database\Eloquent\Builder;

class TypesMethod implements CarFilterMethod
{
    public function supports(CarFilterQueryDto $filter): bool
    {
        return !empty($filter->types);
    }

    public function apply(Builder $queryBuilder, CarFilterQueryDto $filter): void
    {
        $queryBuilder
            ->join('car_types AS ct', 'c.type_id', '=', 'ct.id')
            ->whereIn('ct.slug', $filter->types)
        ;
    }
}
