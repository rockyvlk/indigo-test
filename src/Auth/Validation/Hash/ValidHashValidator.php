<?php

declare(strict_types=1);

namespace App\Auth\Validation\Hash;

use App\Auth\Services\Link\HashCheckerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

final class ValidHashValidator extends ConstraintValidator
{
    public function __construct(private readonly HashCheckerInterface $hashChecker)
    {

    }

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof ValidHash) {
            throw new UnexpectedTypeException($constraint, ValidHash::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if(!$this->hashChecker->isValid($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}
