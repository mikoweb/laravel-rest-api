<?php

namespace App\Core\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

trait HasBinaryUuids
{
    use HasUuids;

    public function newUniqueId(): string
    {
        return Uuid::uuid7()->getBytes();
    }

    public function getId(): UuidInterface
    {
        return Uuid::fromBytes($this->getAttribute('id'));
    }
}
