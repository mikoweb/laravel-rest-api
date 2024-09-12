<?php

namespace App\Core\UI\Controller;

use WayOfDev\Serializer\Bridge\Laravel\Http\ResponseFactory;

abstract class RestController extends Controller
{
    public function __construct(
        protected ResponseFactory $response,
    ) {
    }
}
