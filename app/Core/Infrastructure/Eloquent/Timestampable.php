<?php

namespace App\Core\Infrastructure\Eloquent;

use Carbon\CarbonInterface;
use Doctrine\ORM\Mapping as ORM;

trait Timestampable
{
    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: true)]
    protected ?CarbonInterface $createdAt;

    #[ORM\Column(name: 'updated_at', type: 'datetime', nullable: true)]
    protected ?CarbonInterface $updatedAt;

    public function getCreatedAt(): ?CarbonInterface
    {
        return $this->getAttribute('created_at');
    }

    public function getUpdatedAt(): ?CarbonInterface
    {
        return $this->getAttribute('updated_at');
    }
}
