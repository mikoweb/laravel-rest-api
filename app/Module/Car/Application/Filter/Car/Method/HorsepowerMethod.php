<?php

namespace App\Module\Car\Application\Filter\Car\Method;

use App\Module\Car\Application\Filter\Car\CarFilterMethod;
use App\Module\Car\UI\Dto\CarFilterQueryDto;
use Illuminate\Database\Eloquent\Builder;

class HorsepowerMethod implements CarFilterMethod
{
    public function supports(CarFilterQueryDto $filter): bool
    {
        return !is_null($filter->horsepowerFrom) || !is_null($filter->horsepowerTo);
    }

    public function apply(Builder $queryBuilder, CarFilterQueryDto $filter): void
    {
        if (!is_null($filter->horsepowerFrom)) {
            $queryBuilder->where('c.horsepower', '>=', $filter->horsepowerFrom);
        }

        if (!is_null($filter->horsepowerTo)) {
            $queryBuilder->where('c.horsepower', '<=', $filter->horsepowerTo);
        }
    }
}
