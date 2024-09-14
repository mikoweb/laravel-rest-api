<?php

namespace App\Module\Car\Application\Interaction\Query\AskForCarsPaginatedList\Handler;

use App\Core\Application\Pagination\PaginatedHandler;
use App\Core\Application\Pagination\PaginationFactory;
use App\Core\Domain\Pagination\Pagination;
use App\Module\Car\Application\Filter\Car\CarFilter;
use App\Module\Car\Application\Interaction\Query\AskForCarsPaginatedList\AskForCarsPaginatedListQuery;
use App\Module\Car\Domain\Model\Car;
use App\Shared\UI\Dto\Car\CarDto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AskForCarsPaginatedListHandler extends PaginatedHandler
{
    public function __construct(
        private readonly CarFilter $carFilter,
        PaginationFactory $paginationFactory,
    ) {
        parent::__construct($paginationFactory);
    }

    public function handle(AskForCarsPaginatedListQuery $query): Pagination
    {
        /** @var Builder<Model> $qb */
        $qb = Car::withAll()->orderBy('name');

        if (!is_null($query->carFilterQuery)) {
            $this->carFilter->apply($qb, $query->carFilterQuery);
        }

        return $this->paginate($qb, $query->paginationRequest);
    }

    protected function getItems(array $items): array
    {
        return array_map(fn (Car $car) => CarDto::fromModel($car), $items);
    }
}
