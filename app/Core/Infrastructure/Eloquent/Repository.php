<?php

namespace App\Core\Infrastructure\Eloquent;

use Prettus\Repository\Contracts\RepositoryInterface;

interface Repository extends RepositoryInterface
{
    /**
     * @param string[] $relations
     * @param string[] $columns
     */
    public function findByBinaryUuid(string $id, array $relations = [], array $columns = ['*']): ?object;
}
