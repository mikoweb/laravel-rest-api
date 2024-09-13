<?php

namespace App\Core\Application\Pagination;

use App\Core\Domain\Pagination\Pagination;
use App\Core\Domain\Pagination\PaginationRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

abstract class PaginatedHandler
{
    public function __construct(
        protected PaginationFactory $paginationFactory,
    ) {
    }

    /**
     * @param Builder<Model> $queryBuilder
     */
    protected function paginate(Builder $queryBuilder, PaginationRequest $request): Pagination
    {
        $pagination = $this->createPagination($queryBuilder, $request);
        $items = $this->getItems($pagination->getCollection()->all());

        return $this->paginationFactory->create($pagination, $items);
    }

    /**
     * @param Builder<Model> $queryBuilder
     */
    protected function createPagination(
        Builder $queryBuilder,
        PaginationRequest $request,
    ): AbstractPaginator|LengthAwarePaginator {
        return $queryBuilder->paginate(perPage: $request->limit, page: $request->page);
    }

    /**
     * @param object[] $items
     *
     * @return object[]
     */
    abstract protected function getItems(array $items): array;
}
