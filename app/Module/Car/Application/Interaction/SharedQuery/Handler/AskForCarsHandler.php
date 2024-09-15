<?php

namespace App\Module\Car\Application\Interaction\SharedQuery\Handler;

use App\Module\Car\Domain\Model\Car;
use App\Shared\Application\Interaction\SharedQuery\Car\AskForCarsSharedQuery;
use App\Shared\UI\Dto\Car\CarDto;
use Illuminate\Validation\ValidationException;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

class AskForCarsHandler
{
    /**
     * @return CarDto[]
     *
     * @throws ValidationException
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    public function handle(AskForCarsSharedQuery $query): array
    {
        $cars = Car::withAll()->whereIn('id', $query->ids)->get()->all();

        return array_map(fn (Car $car) => CarDto::fromModel($car), $cars);
    }
}
