<?php

namespace App\Shared\Domain;

use OpenApi\Attributes as OA;
use PhpUnitConversion\Unit;
use Symfony\Component\Serializer\Attribute\Groups;

#[OA\Schema(
    schema: 'Shared_UnitValue',
    properties: [
        new OA\Property(property: 'value', type: 'float'),
        new OA\Property(property: 'textValue', type: 'string'),
        new OA\Property(property: 'symbol', type: 'string'),
        new OA\Property(property: 'label', type: 'string'),
    ]
)]
final readonly class UnitValue
{
    public function __construct(
        #[Groups(['unit_value', 'list'])]
        public float $value,

        #[Groups(['unit_value', 'list'])]
        public string $textValue,

        #[Groups(['unit_value', 'list'])]
        public string $symbol,

        #[Groups(['unit_value', 'list'])]
        public string $label,
    ) {
    }

    public static function createFromUnit(Unit $unit, int $precision = 3, bool $addSymbol = true): self
    {
        return new self(
            value: $unit->getValue(),
            textValue: $unit->format($precision, $addSymbol),
            symbol: $unit->getSymbol(),
            label: $unit->getLabel(),
        );
    }
}
