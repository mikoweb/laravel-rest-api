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

        foreach ($this->getBinaryUuidColumns() as $column) {
            if (isset($data[$column]) && is_string($data[$column])) {
                $data[$column] = Uuid::fromBytes($data[$column])->toString();
            }
        }

        return $data;
    }

    /**
     * @return string[]
     */
    public function getBinaryUuidColumns(): array
    {
        return [$this->getKeyName()];
    }
}
