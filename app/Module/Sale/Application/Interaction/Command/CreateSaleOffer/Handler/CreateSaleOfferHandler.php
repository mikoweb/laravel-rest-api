<?php

namespace App\Module\Sale\Application\Interaction\Command\CreateSaleOffer\Handler;

use App\Module\Sale\Application\Interaction\Command\CreateSaleOffer\CreateSaleOfferCommand;
use App\Module\Sale\Domain\Model\SaleOffer;
use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class CreateSaleOfferHandler
{
    public function handle(CreateSaleOfferCommand $command): UuidInterface
    {
        $saleOffer = SaleOffer::create(
            title: $command->dto->title,
            content: $command->dto->content,
            price: new Money(
                (int) ($command->dto->price * 100),
                new Currency($command->dto->currencyCode),
            ),
            carId: Uuid::fromString($command->dto->carId),
        );

        $saleOffer->save();

        return $saleOffer->getId();
    }
}
