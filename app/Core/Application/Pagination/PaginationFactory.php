<?php

namespace App\Core\Application\Pagination;

use App\Core\Domain\Pagination\Pagination;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class PaginationFactory
{
    /**
     * @param object[]|null $items
     */
    public function create(
        AbstractPaginator&LengthAwarePaginator $pagination,
        ?array $items = null,
    ): Pagination {
        $collectionItems = $pagination->getCollection()->all();

        return new Pagination(
            items: $items ?? $collectionItems,
            rawItems: $collectionItems,
            currentPage: $pagination->currentPage(),
            lastPage: $pagination->lastPage(),
            perPage: $pagination->perPage(),
            total: $pagination->total(),
            offset: $pagination->currentPage() * $pagination->perPage() - $pagination->perPage(),
        );
    }
}
