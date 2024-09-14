<?php

namespace App\Module\Car\UI\Dto;

use WendellAdriel\ValidatedDTO\Attributes\Cast;
use WendellAdriel\ValidatedDTO\Attributes\Rules;
use WendellAdriel\ValidatedDTO\Casting\FloatCast;
use WendellAdriel\ValidatedDTO\Concerns\EmptyCasts;
use WendellAdriel\ValidatedDTO\Concerns\EmptyDefaults;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class CarFilterQueryDto extends ValidatedDTO
{
    use EmptyCasts;
    use EmptyDefaults;

    #[Rules(['string', 'min:2', 'max:150'])]
    public ?string $nameLike = null;

    /**
     * @var string[]|null
     */
    #[Rules(['array'])]
    public ?array $manufacturers = null;

    /**
     * @var string[]|null
     */
    #[Rules(['array'])]
    public ?array $types = null;

    /**
     * @var string[]|null
     */
    #[Rules(['array'])]
    public ?array $regions = null;

    /**
     * @var string[]|null
     */
    #[Rules(['array'])]
    public ?array $driveTrains = null;

    #[Rules(['numeric', 'gte:0'])]
    #[Cast(type: FloatCast::class)]
    public ?float $horsepowerFrom = null;

    #[Rules(['numeric', 'gte:0'])]
    #[Cast(type: FloatCast::class)]
    public ?float $horsepowerTo = null;

    #[Rules(['numeric', 'gte:0'])]
    #[Cast(type: FloatCast::class)]
    public ?float $engineSizeFrom = null;

    #[Rules(['numeric', 'gte:0'])]
    #[Cast(type: FloatCast::class)]
    public ?float $engineSizeTo = null;

    #[Rules(['numeric', 'gte:0'])]
    #[Cast(type: FloatCast::class)]
    public ?float $cylindersFrom = null;

    #[Rules(['numeric', 'gte:0'])]
    #[Cast(type: FloatCast::class)]
    public ?float $cylindersTo = null;

    /**
     * @return array<string, string[]>
     */
    public function rules(): array
    {
        return [
            'manufacturers.*' => ['string', 'min:1', 'max:60'],
            'types.*' => ['string', 'min:1', 'max:60'],
            'regions.*' => ['string', 'min:1', 'max:60'],
            'driveTrains.*' => ['string', 'min:1', 'max:60'],
        ];
    }
}
