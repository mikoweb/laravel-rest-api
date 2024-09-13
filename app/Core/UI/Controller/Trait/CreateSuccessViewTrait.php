<?php

namespace App\Core\UI\Controller\Trait;

use App\Core\UI\Dto\Api\Response\SuccessResponseDto;
use Illuminate\Http\Response;

trait CreateSuccessViewTrait
{
    protected function createSuccessView(string $message, ?object $responseData = null): Response
    {
        return $this->response->create(new SuccessResponseDto($message, $responseData));
    }
}
