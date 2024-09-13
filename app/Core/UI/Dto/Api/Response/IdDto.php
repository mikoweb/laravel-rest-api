<?php

namespace App\Core\UI\Dto\Api\Response;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'IdDto',
    properties: [
        new OA\Property(property: 'id', type: 'string'),
    ]
)]
readonly class IdDto
{
    public function __construct(
        public string $id,
    ) {
    }
}
