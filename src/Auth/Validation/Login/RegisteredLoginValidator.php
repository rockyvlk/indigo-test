<?php

declare(strict_types=1);

namespace App\Auth\Validation\Login;

use App\Auth\Read\AuthUser\AuthUserFetcher;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

final class RegisteredLoginValidator extends ConstraintValidator
{
    public function __construct(private readonly AuthUserFetcher $authUserFetcher)
    {

    }

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof RegisteredLogin) {
            throw new UnexpectedTypeException($constraint, RegisteredLogin::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        $user = $this->authUserFetcher->findByLogin($value);

        if(!$user) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}
