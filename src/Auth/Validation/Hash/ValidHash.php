<?php

declare(strict_types=1);

namespace App\Auth\Validation\Hash;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
final class ValidHash extends Constraint
{
    public string $message = 'Hash {{ string }} not valid';

    public function validatedBy()
    {
        return self::class.'Validator';
    }
}
