<?php

namespace App\Module\Car\UI\Controller;

use App\Core\Domain\Pagination\PaginationRequest;
use App\Core\Infrastructure\Bus\QueryBusInterface;
use App\Core\UI\Controller\RestController;
use App\Module\Car\Application\Interaction\Query\AskForCarsPaginatedList\AskForCarsPaginatedListQuery;
use App\Module\Car\Domain\Model\Car;
use App\Module\Car\Infrastructure\Repository\CarRepository;
use App\Module\Car\UI\Dto\CarFilterQueryDto;
use App\Shared\UI\Dto\Car\CarDto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;

class CarController extends RestController
{
    #[OA\Parameter(name: 'page', in: 'query')]
    #[OA\Parameter(name: 'limit', in: 'query')]
    #[OA\Parameter(name: 'nameLike', in: 'query')]
    #[OA\Parameter(name: 'manufacturers[]', in: 'query')]
    #[OA\Parameter(name: 'types[]', in: 'query')]
    #[OA\Parameter(name: 'regions[]', in: 'query')]
    #[OA\Parameter(name: 'driveTrains[]', in: 'query')]
    #[OA\Parameter(name: 'horsepowerFrom', in: 'query')]
    #[OA\Parameter(name: 'horsepowerTo', in: 'query')]
    #[OA\Parameter(name: 'engineSizeFrom', in: 'query')]
    #[OA\Parameter(name: 'engineSizeTo', in: 'query')]
    #[OA\Parameter(name: 'cylindersFrom', in: 'query')]
    #[OA\Parameter(name: 'cylindersTo', in: 'query')]
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
        CarFilterQueryDto $carFilterQuery,
    ): Response {
        $pagination = $queryBus->dispatch(new AskForCarsPaginatedListQuery(
            PaginationRequest::createFromRequest($request),
            $carFilterQuery,
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
