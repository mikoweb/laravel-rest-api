<?php

namespace App\Core\UI\Controller;

use App\Core\UI\Controller\Trait\CreateErrorViewTrait;
use App\Core\UI\Controller\Trait\CreateSuccessViewTrait;
use OpenApi\Attributes as OA;
use WayOfDev\Serializer\Bridge\Laravel\Http\ResponseFactory;

#[OA\Info(version: '0.0.1', title: 'Laravel REST API')]
#[OA\Server(url: '/api')]
abstract class RestController extends Controller
{
    use CreateSuccessViewTrait;
    use CreateErrorViewTrait;

    protected const string COMMON_EXCEPTION_MESSAGE = 'Something went wrong...';

    public function __construct(
        protected ResponseFactory $response,
    ) {
    }
}
