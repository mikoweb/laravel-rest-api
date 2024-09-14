<?php

namespace App\Module\Car\Application\Interaction\Query\AskForCarsPaginatedList;

use App\Core\Domain\Pagination\PaginationRequest;
use App\Core\Infrastructure\Interaction\Query\QueryInterface;
use App\Module\Car\UI\Dto\CarFilterQueryDto;

readonly class AskForCarsPaginatedListQuery implements QueryInterface
{
    public function __construct(
        public PaginationRequest $paginationRequest,
        public ?CarFilterQueryDto $carFilterQuery = null,
    ) {
    }
}
