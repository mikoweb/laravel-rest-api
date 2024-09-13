<?php

namespace App\Core\Domain\Pagination;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Attribute\Ignore;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Pagination',
    title: 'Pagination DTO',
    properties: [
        new OA\Property(property: 'currentPage', type: 'integer'),
        new OA\Property(property: 'lastPage', type: 'integer'),
        new OA\Property(property: 'perPage', type: 'integer'),
        new OA\Property(property: 'total', type: 'integer'),
        new OA\Property(property: 'offset', type: 'integer'),
    ]
)]
final readonly class Pagination
{
    public function __construct(
        /**
         * @var object[]
         */
        #[Groups(['pagination'])]
        public array $items,

        /**
         * @var object[]
         */
        #[Ignore]
        public array $rawItems,
        #[Groups(['pagination'])]
        public int $currentPage,
        #[Groups(['pagination'])]
        public int $lastPage,
        #[Groups(['pagination'])]
        public int $perPage,
        #[Groups(['pagination'])]
        public int $total,
        #[Groups(['pagination'])]
        public int $offset,
    ) {
    }
}
