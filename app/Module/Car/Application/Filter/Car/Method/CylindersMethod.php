<?php

namespace App\Module\Car\Application\Filter\Car\Method;

use App\Module\Car\Application\Filter\Car\CarFilterMethod;
use App\Module\Car\UI\Dto\CarFilterQueryDto;
use Illuminate\Database\Eloquent\Builder;

class CylindersMethod implements CarFilterMethod
{
    public function supports(CarFilterQueryDto $filter): bool
    {
        return !is_null($filter->cylindersFrom) || !is_null($filter->cylindersTo);
    }

    public function apply(Builder $queryBuilder, CarFilterQueryDto $filter): void
    {
        if (!is_null($filter->cylindersFrom)) {
            $queryBuilder->where('c.cylinders', '>=', $filter->cylindersFrom);
        }

        if (!is_null($filter->cylindersTo)) {
            $queryBuilder->where('c.cylinders', '<=', $filter->cylindersTo);
        }
    }
}
