<?php

namespace App\Module\Car\Application\Filter\Car;

use App\Module\Car\Application\Filter\Car\Method\CylindersMethod;
use App\Module\Car\Application\Filter\Car\Method\DriveTrainsMethod;
use App\Module\Car\Application\Filter\Car\Method\EngineSizeMethod;
use App\Module\Car\Application\Filter\Car\Method\HorsepowerMethod;
use App\Module\Car\Application\Filter\Car\Method\ManufacturersMethod;
use App\Module\Car\Application\Filter\Car\Method\NameLikeMethod;
use App\Module\Car\Application\Filter\Car\Method\RegionsMethod;
use App\Module\Car\Application\Filter\Car\Method\TypesMethod;
use App\Module\Car\UI\Dto\CarFilterQueryDto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

readonly class CarFilter
{
    /**
     * @var CarFilterMethod[]
     */
    private array $methods;

    public function __construct(
        NameLikeMethod $nameLikeMethod,
        ManufacturersMethod $manufacturersMethod,
        TypesMethod $typesMethod,
        RegionsMethod $regionsMethod,
        DriveTrainsMethod $driveTrainsMethod,
        HorsepowerMethod $horsepowerMethod,
        EngineSizeMethod $engineSizeMethod,
        CylindersMethod $cylindersMethod,
    ) {
        $this->methods = func_get_args();
    }

    /**
     * @param Builder<Model> $queryBuilder
     */
    public function apply(Builder $queryBuilder, CarFilterQueryDto $filter): bool
    {
        $applied = false;

        foreach ($this->methods as $method) {
            if ($method->supports($filter)) {
                $method->apply($queryBuilder, $filter);
                $applied = true;
            }
        }

        if ($applied) {
            $queryBuilder
                ->from('cars', 'c')
                ->select('c.*')
            ;
        }

        return $applied;
    }
}
