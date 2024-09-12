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

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = parent::toArray();

        if (is_array($data) && isset($data['id']) && is_string($data['id'])) {
            $data['id'] = Uuid::fromBytes($data['id'])->toString();
        }

        return $data;
    }
}
