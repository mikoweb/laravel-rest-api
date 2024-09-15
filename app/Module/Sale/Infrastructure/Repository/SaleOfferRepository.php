<?php

namespace App\Module\Sale\Infrastructure\Repository;

use App\Core\Infrastructure\Eloquent\Repository;
use JeroenG\Autowire\Attribute\Autowire;

#[Autowire]
interface SaleOfferRepository extends Repository
{
}
