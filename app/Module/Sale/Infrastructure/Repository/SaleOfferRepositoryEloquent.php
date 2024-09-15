<?php

namespace App\Module\Sale\Infrastructure\Repository;

use App\Core\Infrastructure\Eloquent\BaseRepository;
use App\Module\Sale\Domain\Model\SaleOffer;

class SaleOfferRepositoryEloquent extends BaseRepository implements SaleOfferRepository
{
    public function model(): string
    {
        return SaleOffer::class;
    }
}
