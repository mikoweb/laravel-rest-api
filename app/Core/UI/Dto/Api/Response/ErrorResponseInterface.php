<?php

namespace App\Core\UI\Dto\Api\Response;

interface ErrorResponseInterface
{
    public function getError(): string;
    public function setError(string $error): static;
}
