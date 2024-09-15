<?php

namespace App\Module\Car\Application\Interaction\SharedQuery\Handler;

use App\Core\Application\Exception\NotFoundException;
use App\Module\Car\Domain\Model\Car;
use App\Module\Car\Infrastructure\Repository\CarRepository;
use App\Shared\Application\Interaction\SharedQuery\Car\AskForCarSharedQuery;
use App\Shared\UI\Dto\Car\CarDto;
use Illuminate\Validation\ValidationException;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

readonly class AskForCarHandler
{
    public function __construct(
        private CarRepository $carRepository,
    ) {
    }

    /**
     * @throws NotFoundException
     * @throws ValidationException
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    public function handle(AskForCarSharedQuery $query): CarDto
    {
        /** @var Car|null $car */
        $car = $this->carRepository->findByBinaryUuid($query->id);

        if (is_null($car)) {
            throw new NotFoundException(sprintf('Car with UUID `%s` not found', $query->id));
        }

        return CarDto::fromModel($car);
    }
}
