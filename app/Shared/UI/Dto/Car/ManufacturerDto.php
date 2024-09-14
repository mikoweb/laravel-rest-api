<?php

namespace App\Shared\UI\Dto\Car;

use Symfony\Component\Serializer\Attribute\Groups;
use OpenApi\Attributes as OA;
use WendellAdriel\ValidatedDTO\Concerns\EmptyCasts;
use WendellAdriel\ValidatedDTO\Concerns\EmptyDefaults;
use WendellAdriel\ValidatedDTO\SimpleDTO;

#[OA\Schema(
    schema: 'Shared_Car_ManufacturerDto',
    properties: [
        new OA\Property(property: 'name', type: 'string'),
        new OA\Property(property: 'slug', type: 'string'),
    ]
)]
class ManufacturerDto extends SimpleDTO
{
    use EmptyCasts;
    use EmptyDefaults;

    #[Groups(['list'])]
    public string $name;

    #[Groups(['list'])]
    public string $slug;
}
