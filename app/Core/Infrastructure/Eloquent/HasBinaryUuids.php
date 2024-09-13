<?php

namespace App\Core\Infrastructure\Eloquent;

use Doctrine\ORM\Mapping as ORM;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Ramsey\Uuid\Doctrine\UuidBinaryType;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

trait HasBinaryUuids
{
    use HasUuids;

    #[ORM\Id]
    #[ORM\Column(name: 'id', type: UuidBinaryType::NAME, unique: true)]
    private mixed $id;

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
