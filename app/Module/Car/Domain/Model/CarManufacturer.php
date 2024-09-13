<?php

namespace App\Module\Car\Domain\Model;

use App\Core\Infrastructure\Eloquent\HasBinaryUuids;
use App\Core\Infrastructure\Eloquent\Timestampable;
use Cviebrock\EloquentSluggable\Sluggable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ORM\Entity]
#[ORM\Table(name: 'car_manufacturers')]
class CarManufacturer extends Model
{
    /**
     * @use HasFactory<Factory>
     */
    use HasFactory;
    use HasBinaryUuids;
    use Sluggable;
    use Timestampable;

    protected $table = 'car_manufacturers';
    protected $guarded = [];

    #[ORM\Column(name: 'name', type: Types::STRING, length: 50, unique: true, nullable: false)]
    private string $name;

    #[ORM\Column(name: 'slug', type: Types::STRING, length: 60, unique: true, nullable: false)]
    private string $slug;

    public static function create(string $name): self
    {
        return new self(['name' => $name]);
    }

    /**
     * @return array<string, array<string, string>>
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function getName(): string
    {
        return $this->getAttribute('name');
    }

    public function setName(string $name): self
    {
        $this->setAttribute('name', $name);

        return $this;
    }

    public function getSlug(): string
    {
        return $this->getAttribute('slug');
    }
}
