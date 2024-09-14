<?php

namespace App\Module\Car\Application\Filter\Car\Method;

use App\Module\Car\Application\Filter\Car\CarFilterMethod;
use App\Module\Car\UI\Dto\CarFilterQueryDto;
use Illuminate\Database\Eloquent\Builder;

class DriveTrainsMethod implements CarFilterMethod
{
    public function supports(CarFilterQueryDto $filter): bool
    {
        return !empty($filter->driveTrains);
    }

    public function apply(Builder $queryBuilder, CarFilterQueryDto $filter): void
    {
        $queryBuilder->whereIn('c.drive_train', $filter->driveTrains);
    }
}
