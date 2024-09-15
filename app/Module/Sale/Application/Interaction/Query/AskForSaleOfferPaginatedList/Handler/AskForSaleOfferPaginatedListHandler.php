<?php

namespace App\Module\Sale\Application\Interaction\Query\AskForSaleOfferPaginatedList\Handler;

use App\Core\Application\Exception\NotFoundException;
use App\Core\Application\Pagination\PaginatedHandler;
use App\Core\Application\Pagination\PaginationFactory;
use App\Core\Domain\Pagination\Pagination;
use App\Core\Infrastructure\Bus\SharedQueryBusInterface;
use App\Module\Sale\Application\Interaction\Query\AskForSaleOfferPaginatedList\AskForSaleOfferPaginatedListQuery;
use App\Module\Sale\Domain\Model\SaleOffer;
use App\Module\Sale\UI\Dto\SaleOfferDto;
use App\Shared\Application\Interaction\SharedQuery\Car\AskForCarsSharedQuery;
use App\Shared\UI\Dto\Car\CarDto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Collection\Map\TypedMap;

class AskForSaleOfferPaginatedListHandler extends PaginatedHandler
{
    public function __construct(
        private readonly SharedQueryBusInterface $sharedQueryBus,
        PaginationFactory $paginationFactory,
    ) {
        parent::__construct($paginationFactory);
    }

    public function handle(AskForSaleOfferPaginatedListQuery $query): Pagination
    {
        /** @var Builder<Model> $qb */
        $qb = SaleOffer::query()->orderBy('created_at', 'desc');

        return $this->paginate($qb, $query->paginationRequest);
    }

    protected function getItems(array $items): array
    {
        $carIds = array_unique(array_map(fn (SaleOffer $saleOffer) => $saleOffer->getCarId()->getBytes(), $items));
        /** @var CarDto[] $cars */
        $cars = $this->sharedQueryBus->dispatch(new AskForCarsSharedQuery($carIds));
        $carMap = new TypedMap('string', CarDto::class);

        foreach ($cars as $car) {
            $carMap->put($car->id, $car);
        }

        return array_map(function (SaleOffer $saleOffer) use ($carMap) {
            /** @var CarDto|null $car */
            $car = $carMap->get($saleOffer->getCarId()->toString());

            if (is_null($car)) {
                throw new NotFoundException(sprintf('Car with ID `%s` not found', $saleOffer->getCarId()->toString()));
            }

            return SaleOfferDto::fromArray(
                array_merge($saleOffer->toArray(), [
                    'car' => $car->toArray(),
                ])
            );
        }, $items);
    }
}
