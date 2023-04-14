<?php

declare(strict_types=1);

namespace App\Auth\Validation\Login;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
final class AvailableLogin extends Constraint
{
    public string $message = 'The login {{ string }} already registered';

    public function validatedBy()
    {
        return self::class.'Validator';
    }
}
