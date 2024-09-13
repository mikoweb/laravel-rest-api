<?php

namespace App\Core\UI\Dto\Api\Response;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'SuccessResponseDto',
    properties: [
        new OA\Property(property: 'message', type: 'string'),
    ]
)]
class SuccessResponseDto implements SuccessResponseInterface
{
    public function __construct(
        private string $message,
        private ?object $responseData = null,
    ) {
    }

    public function getResponseData(): ?object
    {
        return $this->responseData;
    }

    public function setResponseData(?object $responseData): static
    {
        $this->responseData = $responseData;

        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }
}
