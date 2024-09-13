<?php

namespace App\Core\UI\Dto\Api\Response;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ErrorResponseDto',
    properties: [
        new OA\Property(property: 'error', type: 'string'),
    ]
)]
class ErrorResponseDto implements ErrorResponseInterface
{
    public function __construct(
        private string $error,
    ) {
    }

    public function getError(): string
    {
        return $this->error;
    }

    public function setError(string $error): static
    {
        $this->error = $error;

        return $this;
    }
}
