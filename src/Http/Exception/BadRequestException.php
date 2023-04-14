<?php

declare(strict_types=1);

namespace App\Http\Exception;

use RuntimeException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class BadRequestException extends RuntimeException
{
    public function __construct(
        private ConstraintViolationListInterface $violations
    ) {
        parent::__construct('Ошибка валидации запроса', 400);
    }

    /**
     * @return array<ConstraintViolation>
     */
    public function getConstraints(): array
    {
        $violations = [];
        /**
         * @var ConstraintViolation $violation
         */
        foreach ($this->violations as $violation) {
            $violations[] = $violation;
        }

        return $violations;
    }
}
