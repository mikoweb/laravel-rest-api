<?php

namespace App\Shared\UI\Dto\Car;

use App\Shared\Domain\UnitValue;
use Carbon\CarbonImmutable;
use OpenApi\Attributes as OA;
use PhpUnitConversion\Unit\Mass\KiloGram;
use PhpUnitConversion\Unit\Mass\Pound;
use PhpUnitConversion\Unit\Volume\Liter;
use Symfony\Component\Serializer\Attribute\Groups;
use WendellAdriel\ValidatedDTO\Attributes\Cast;
use WendellAdriel\ValidatedDTO\Attributes\Map;
use WendellAdriel\ValidatedDTO\Casting\CarbonImmutableCast;
use WendellAdriel\ValidatedDTO\Casting\Castable;
use WendellAdriel\ValidatedDTO\Casting\DTOCast;
use WendellAdriel\ValidatedDTO\Concerns\EmptyDefaults;
use WendellAdriel\ValidatedDTO\SimpleDTO;
use UnexpectedValueException;

#[OA\Schema(
    schema: 'Shared_Car_CarDto',
    properties: [
        new OA\Property(property: 'id', type: 'string'),
        new OA\Property(property: 'name', type: 'string'),
        new OA\Property(property: 'slug', type: 'string'),
        new OA\Property(property: 'model', type: 'string'),
        new OA\Property(property: 'driveTrain', type: 'string'),
        new OA\Property(property: 'engineSize', anyOf: [
            new OA\Schema(ref: '#/components/schemas/Shared_UnitValue'),
        ]),
        new OA\Property(property: 'cylinders', type: 'integer', nullable: true),
        new OA\Property(property: 'horsepower', type: 'integer'),
        new OA\Property(property: 'weight', anyOf: [
            new OA\Schema(ref: '#/components/schemas/Shared_UnitValue'),
        ]),
        new OA\Property(property: 'manufacturer', anyOf: [
            new OA\Schema(ref: '#/components/schemas/Shared_Car_ManufacturerDto'),
        ]),
        new OA\Property(property: 'type', anyOf: [
            new OA\Schema(ref: '#/components/schemas/Shared_Car_TypeDto'),
        ]),
        new OA\Property(property: 'region', anyOf: [
            new OA\Schema(ref: '#/components/schemas/Shared_Car_RegionDto'),
        ]),
        new OA\Property(property: 'createdAt', type: 'string', nullable: true),
        new OA\Property(property: 'updatedAt', type: 'string', nullable: true),
    ]
)]
class CarDto extends SimpleDTO
{
    use EmptyDefaults;

    #[Groups(['list'])]
    public string $id;

    #[Groups(['list'])]
    public string $name;

    #[Groups(['list'])]
    public string $slug;

    #[Groups(['list'])]
    public string $model;

    #[Groups(['list'])]
    #[Map(data: 'drive_train')]
    public string $driveTrain;

    #[Groups(['list'])]
    #[Map(data: 'engine_size')]
    public UnitValue $engineSize;

    #[Groups(['list'])]
    public ?int $cylinders;

    #[Groups(['list'])]
    public int $horsepower;

    #[Groups(['list'])]
    public UnitValue $weight;

    #[Groups(['list'])]
    public ?ManufacturerDto $manufacturer;

    #[Groups(['list'])]
    public ?TypeDto $type;

    #[Groups(['list'])]
    public ?RegionDto $region;

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
            'manufacturer' => new DTOCast(ManufacturerDto::class),
            'type' => new DTOCast(TypeDto::class),
            'region' => new DTOCast(RegionDto::class),
            'engineSize' => function (string $property, mixed $value) {
                return match (gettype($value)) {
                    'string' => UnitValue::createFromUnit(new Liter((float) $value), 1),
                    'array' => new UnitValue(...$value),
                    default => new UnexpectedValueException(
                        sprintf('Unexpected engineSize type `%s`', gettype($value)),
                    ),
                };
            },
            'weight' => function (string $property, mixed $value) {
                return match (gettype($value)) {
                    'integer' => UnitValue::createFromUnit((new Pound($value))->to(KiloGram::class), 0),
                    'array' => new UnitValue(...$value),
                    default => new UnexpectedValueException(
                        sprintf('Unexpected weight type `%s`', gettype($value)),
                    ),
                };
            },
        ];
    }
}
