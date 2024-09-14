<?php

namespace App\Module\Car\Application\Filter\Car\Method;

use App\Module\Car\Application\Filter\Car\CarFilterMethod;
use App\Module\Car\UI\Dto\CarFilterQueryDto;
use Illuminate\Database\Eloquent\Builder;

use function Symfony\Component\String\u;

class NameLikeMethod implements CarFilterMethod
{
    public function supports(CarFilterQueryDto $filter): bool
    {
        return !is_null($filter->nameLike);
    }

    public function apply(Builder $queryBuilder, CarFilterQueryDto $filter): void
    {
        $queryBuilder->whereLike('c.name', u($filter->nameLike)->append('%')->toString());
    }
}
