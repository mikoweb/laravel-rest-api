<?php

namespace App\Module\Car\Infrastructure\Repository;

use App\Core\Infrastructure\Eloquent\Repository;
use JeroenG\Autowire\Attribute\Autowire;

#[Autowire]
interface CarRepository extends Repository
{
}
