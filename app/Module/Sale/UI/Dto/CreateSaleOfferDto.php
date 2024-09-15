<?php

namespace App\Module\Sale\UI\Dto;

use OpenApi\Attributes as OA;
use WendellAdriel\ValidatedDTO\Attributes\Cast;
use WendellAdriel\ValidatedDTO\Attributes\Rules;
use WendellAdriel\ValidatedDTO\Casting\FloatCast;
use WendellAdriel\ValidatedDTO\Concerns\EmptyCasts;
use WendellAdriel\ValidatedDTO\Concerns\EmptyDefaults;
use WendellAdriel\ValidatedDTO\Concerns\EmptyRules;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

#[OA\Schema(
    schema: 'Sale_CreateSaleOfferDto',
    properties: [
        new OA\Property(property: 'title', type: 'string'),
        new OA\Property(property: 'content', type: 'string'),
        new OA\Property(property: 'price', type: 'float'),
        new OA\Property(property: 'currencyCode', type: 'string'),
        new OA\Property(property: 'carId', type: 'string'),
    ]
)]
class CreateSaleOfferDto extends ValidatedDTO
{
    use EmptyRules;
    use EmptyCasts;
    use EmptyDefaults;

    #[Rules(['required', 'string', 'min:3', 'max:100'])]
    public string $title;

    #[Rules(['required', 'string'])]
    public string $content;

    #[Rules(['required', 'numeric', 'gt:0'])]
    #[Cast(type: FloatCast::class)]
    public float $price;

    #[Rules(['required', 'string', 'min:3', 'max:3'])]
    public string $currencyCode;

    #[Rules(['required', 'string', 'uuid'])]
    public string $carId;
}
