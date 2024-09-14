<?php

namespace App\Module\Car\Application\Interaction\Query\AskForCarsPaginatedList;

use App\Core\Domain\Pagination\PaginationRequest;
use App\Core\Infrastructure\Interaction\Query\QueryInterface;

readonly class AskForCarsPaginatedListQuery implements QueryInterface
{
    public function __construct(
        public PaginationRequest $paginationRequest,
    ) {
    }
}
