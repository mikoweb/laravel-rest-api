<?php

namespace App\Core\Infrastructure\Eloquent;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository as PrettusRepository;
use Ramsey\Uuid\Nonstandard\Uuid;

abstract class BaseRepository extends PrettusRepository implements Repository
{
    public function boot(): void
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function findByBinaryUuid(string $id, array $relations = [], array $columns = ['*']): ?object
    {
        return $this->with($relations)->findByField('id', Uuid::fromString($id)->getBytes(), $columns)->first();
    }
}
