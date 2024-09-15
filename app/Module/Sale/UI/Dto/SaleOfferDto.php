<?php

namespace App\Module\Sale\UI\Dto;

use App\Shared\UI\Dto\Car\CarDto;
use Carbon\CarbonImmutable;
use OpenApi\Attributes as OA;
use Symfony\Component\Serializer\Attribute\Groups;
use WendellAdriel\ValidatedDTO\Attributes\Cast;
use WendellAdriel\ValidatedDTO\Attributes\Map;
use WendellAdriel\ValidatedDTO\Casting\CarbonImmutableCast;
use WendellAdriel\ValidatedDTO\Casting\Castable;
use WendellAdriel\ValidatedDTO\Casting\DTOCast;
use WendellAdriel\ValidatedDTO\Casting\FloatCast;
use WendellAdriel\ValidatedDTO\Concerns\EmptyDefaults;
use WendellAdriel\ValidatedDTO\SimpleDTO;

#[OA\Schema(
    schema: 'Sale_SaleOfferDto',
    properties: [
        new OA\Property(property: 'id', type: 'string'),
        new OA\Property(property: 'title', type: 'string'),
        new OA\Property(property: 'slug', type: 'string'),
        new OA\Property(property: 'content', type: 'string'),
        new OA\Property(property: 'price', type: 'float'),
        new OA\Property(property: 'currencyCode', type: 'string'),
        new OA\Property(property: 'car', anyOf: [
            new OA\Schema(ref: '#/components/schemas/Shared_Car_CarDto'),
        ]),
        new OA\Property(property: 'createdAt', type: 'string', nullable: true),
        new OA\Property(property: 'updatedAt', type: 'string', nullable: true),
    ]
)]
class SaleOfferDto extends SimpleDTO
{
    use EmptyDefaults;

    #[Groups(['list'])]
    public string $id;

    #[Groups(['list'])]
    public string $title;

    #[Groups(['list'])]
    public string $slug;

    #[Groups(['list'])]
    public string $content;

    #[Groups(['list'])]
    #[Cast(type: FloatCast::class)]
    public float $price;

    #[Groups(['list'])]
    #[Map(data: 'currency_code')]
    public string $currencyCode;

    #[Groups(['list'])]
    public CarDto $car;

    #[Groups(['list'])]
    #[Map(data: 'created_at')]
    #[Cast(type: CarbonImmutableCast::class)]
    public ?CarbonImmutable $createdAt;

    #[Groups(['list'])]
    #[Map(data: 'updated_at')]
    #[Cast(type: CarbonImmutableCast::class)]
    public ?CarbonImmutable $updatedAt;

    /**
     * @return array<string, Castable>
     */
    protected function casts(): array
    {
        return [
            'car' => new DTOCast(CarDto::class),
        ];
    }
}
