<?php

namespace App\Core\UI\Controller;

use OpenApi\Attributes as OA;
use WayOfDev\Serializer\Bridge\Laravel\Http\ResponseFactory;

#[OA\Info(version: '0.0.1', title: 'Laravel REST API')]
#[OA\Server(url: '/api')]
abstract class RestController extends Controller
{
    public function __construct(
        protected ResponseFactory $response,
    ) {
    }
}
