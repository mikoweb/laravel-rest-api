<?php

namespace App\Module\Sale\Application\Interaction\Query\AskForSaleOfferPaginatedList;

use App\Core\Domain\Pagination\PaginationRequest;
use App\Core\Infrastructure\Interaction\Query\QueryInterface;

readonly class AskForSaleOfferPaginatedListQuery implements QueryInterface
{
    public function __construct(
        public PaginationRequest $paginationRequest,
    ) {
    }
}
