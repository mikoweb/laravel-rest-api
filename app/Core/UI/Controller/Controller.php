<?php

namespace App\Core\UI\Controller;

use App\Core\Infrastructure\Eloquent\Repository;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

abstract class Controller
{
    protected function createNotFoundException(
        string $message = 'Not Found',
        ?Throwable $previous = null,
    ): NotFoundHttpException {
        return new NotFoundHttpException($message, $previous);
    }

    /**
     * @param string[] $relations
     */
    protected function findModelByBinaryUuid(string $id, Repository $repository, array $relations = []): object
    {
        try {
            $model = $repository->findByBinaryUuid($id, $relations);
        } catch (InvalidUuidStringException) {
            throw $this->createNotFoundException(sprintf('UUID `%s` is invalid', $id));
        }

        if (is_null($model)) {
            throw $this->createNotFoundException(sprintf('Model with UUID `%s` not found', $id));
        }

        return $model;
    }
}
