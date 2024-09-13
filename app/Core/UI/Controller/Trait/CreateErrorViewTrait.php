<?php

namespace App\Core\UI\Controller\Trait;

use App\Core\UI\Dto\Api\Response\ErrorResponseDto;
use Illuminate\Http\Response;
use WayOfDev\Serializer\Bridge\Laravel\Http\HttpCode;

trait CreateErrorViewTrait
{
    protected function createErrorView(string $error = self::COMMON_EXCEPTION_MESSAGE): Response
    {
        $this->response->withStatusCode(HttpCode::HTTP_INTERNAL_SERVER_ERROR);

        return $this->response->create(new ErrorResponseDto($error));
    }
}
