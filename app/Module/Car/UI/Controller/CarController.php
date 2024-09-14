<?php

namespace App\Module\Car\UI\Controller;

use App\Core\Domain\Pagination\PaginationRequest;
use App\Core\Infrastructure\Bus\QueryBusInterface;
use App\Core\UI\Controller\RestController;
use App\Module\Car\Application\Interaction\Query\AskForCarsPaginatedList\AskForCarsPaginatedListQuery;
use App\Module\Car\Domain\Model\Car;
use App\Module\Car\Infrastructure\Repository\CarRepository;
use App\Shared\UI\Dto\Car\CarDto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;

class CarController extends RestController
{
    #[OA\Parameter(name: 'page', in: 'query')]
    #[OA\Parameter(name: 'limit', in: 'query')]
    #[OA\Get(path: '/api/car', tags: ['Car'])]
    #[OA\Response(
        response: 200,
        description: 'Cars List',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'items',
                    type: 'array',
                    items: new OA\Items(
                        anyOf: [new OA\Schema(ref: '#/components/schemas/Shared_Car_CarDto')],
                    ),
                ),
            ],
            anyOf: [new OA\Schema(ref: '#/components/schemas/Pagination')],
        )
    )]
    public function index(
        Request $request,
        QueryBusInterface $queryBus,
    ): Response {
        $pagination = $queryBus->dispatch(new AskForCarsPaginatedListQuery(
            PaginationRequest::createFromRequest($request),
        ));

        $this->response->withContext(['groups' => ['list', 'pagination']]);

        return $this->response->create($pagination);
    }

    #[OA\Get(path: '/api/car/{id}', tags: ['Car'])]
    #[OA\Response(
        response: 200,
        description: 'Single Car',
        content: new OA\JsonContent(
            anyOf: [new OA\Schema(ref: '#/components/schemas/Shared_Car_CarDto')],
        )
    )]
    public function show(string $id, CarRepository $repository): Response
    {
        /** @var Car $car */
        $car = $this->findModelByBinaryUuid($id, $repository, ['manufacturer', 'type', 'region']);

        return $this->response->create(CarDto::fromModel($car));
    }
}
