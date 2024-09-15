<?php

namespace App\Module\Sale\Application\Interaction\Command\CreateSaleOffer;

use App\Core\Infrastructure\Interaction\Command\CommandInterface;
use App\Module\Sale\UI\Dto\CreateSaleOfferDto;

readonly class CreateSaleOfferCommand implements CommandInterface
{
    public function __construct(
        public CreateSaleOfferDto $dto,
    ) {
    }
}
