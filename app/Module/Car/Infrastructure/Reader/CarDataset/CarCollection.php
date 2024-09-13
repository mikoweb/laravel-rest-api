<?php

namespace App\Module\Car\Infrastructure\Reader\CarDataset;

use Ramsey\Collection\AbstractCollection;

/**
 * @extends AbstractCollection<CarRow>
 */
class CarCollection extends AbstractCollection
{
    public function getType(): string
    {
        return CarRow::class;
    }
}
