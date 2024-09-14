<?php

namespace App\Module\Car\Application\Filter\Car\Method;

use App\Module\Car\Application\Filter\Car\CarFilterMethod;
use App\Module\Car\UI\Dto\CarFilterQueryDto;
use Illuminate\Database\Eloquent\Builder;

class EngineSizeMethod implements CarFilterMethod
{
    public function supports(CarFilterQueryDto $filter): bool
    {
        return !is_null($filter->engineSizeFrom) || !is_null($filter->engineSizeTo);
    }

    public function apply(Builder $queryBuilder, CarFilterQueryDto $filter): void
    {
        if (!is_null($filter->engineSizeFrom)) {
            $queryBuilder->where('c.engine_size', '>=', $filter->engineSizeFrom);
        }

        if (!is_null($filter->engineSizeTo)) {
            $queryBuilder->where('c.engine_size', '<=', $filter->engineSizeTo);
        }
    }
}
