<?php

declare(strict_types=1);

namespace App\Auth\Validation\Login;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
final class RegisteredLogin extends Constraint
{
    public string $message = 'The login {{ string }} not registered';

    public function validatedBy()
    {
        return self::class.'Validator';
    }
}
