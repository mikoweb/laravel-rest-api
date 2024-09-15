<?php

namespace App\Module\Sale\UI\Controller;

use App\Core\Domain\Pagination\PaginationRequest;
use App\Core\Infrastructure\Bus\CommandBusInterface;
use App\Core\Infrastructure\Bus\QueryBusInterface;
use App\Core\Infrastructure\Bus\SharedQueryBusInterface;
use App\Core\UI\Controller\RestController;
use App\Core\UI\Dto\Api\Response\IdDto;
use App\Module\Sale\Application\Interaction\Command\CreateSaleOffer\CreateSaleOfferCommand;
use App\Module\Sale\Application\Interaction\Query\AskForSaleOfferPaginatedList\AskForSaleOfferPaginatedListQuery;
use App\Module\Sale\Domain\Model\SaleOffer;
use App\Module\Sale\Infrastructure\Repository\SaleOfferRepository;
use App\Module\Sale\UI\Dto\CreateSaleOfferDto;
use App\Module\Sale\UI\Dto\SaleOfferDto;
use App\Shared\Application\Interaction\SharedQuery\Car\AskForCarSharedQuery;
use App\Shared\UI\Dto\Car\CarDto;
use OpenApi\Attributes as OA;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SaleOfferController extends RestController
{
    #[OA\Parameter(name: 'page', in: 'query')]
    #[OA\Parameter(name: 'limit', in: 'query')]
    #[OA\Get(path: '/api/sale-offer', tags: ['SaleOffer'])]
    #[OA\Response(
        response: 200,
        description: 'Sale Offers List',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'items',
                    type: 'array',
                    items: new OA\Items(
                        anyOf: [new OA\Schema(ref: '#/components/schemas/Sale_SaleOfferDto')],
                    ),
                ),
            ],
            anyOf: [new OA\Schema(ref: '#/components/schemas/Pagination')],
        )
    )]
    public function index(Request $request, QueryBusInterface $queryBus): Response
    {
        $pagination = $queryBus->dispatch(new AskForSaleOfferPaginatedListQuery(
            PaginationRequest::createFromRequest($request),
        ));

        return $this->response->create($pagination);
    }

    #[OA\Get(path: '/api/sale-offer/{id}', tags: ['SaleOffer'])]
    #[OA\Response(
        response: 200,
        description: 'Single Sale Offer',
        content: new OA\JsonContent(
            anyOf: [new OA\Schema(ref: '#/components/schemas/Sale_SaleOfferDto')],
        )
    )]
    public function show(
        string $id,
        SaleOfferRepository $repository,
        SharedQueryBusInterface $sharedQueryBus,
    ): Response {
        /** @var SaleOffer $saleOffer */
        $saleOffer = $this->findModelByBinaryUuid($id, $repository);
        /** @var CarDto $car */
        $car = $sharedQueryBus->dispatch(new AskForCarSharedQuery($saleOffer->getCarId()));

        return $this->response->create(SaleOfferDto::fromArray(
            array_merge(
                $saleOffer->toArray(),
                ['car' => $car->toArray()],
            )
        ));
    }

    #[OA\Post(
        path: '/api/sale-offer',
        requestBody: new OA\RequestBody(content: new OA\JsonContent(
            anyOf: [new OA\Schema(ref: '#/components/schemas/Sale_CreateSaleOfferDto')],
        )),
        tags: ['SaleOffer'],
    )]
    #[OA\Response(
        response: 200,
        description: 'Create Sale Offer',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'responseData',
                    anyOf: [new OA\Schema(ref: '#/components/schemas/IdDto')],
                ),
            ],
            anyOf: [new OA\Schema(ref: '#/components/schemas/SuccessResponseDto')],
        )
    )]
    public function store(CreateSaleOfferDto $dto, CommandBusInterface $commandBus): Response
    {
        $id = $commandBus->dispatch(new CreateSaleOfferCommand($dto));

        return $this->createSuccessView('Sale offer has been created', new IdDto($id->toString()));
    }
}
