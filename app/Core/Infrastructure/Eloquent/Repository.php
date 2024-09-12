<?php

namespace App\Core\Infrastructure\Eloquent;

use Prettus\Repository\Contracts\RepositoryInterface;

interface Repository extends RepositoryInterface
{
    /**
     * @param string[] $columns
     */
    public function findByBinaryUuid(string $id, array $columns = ['*']): ?object;
}
