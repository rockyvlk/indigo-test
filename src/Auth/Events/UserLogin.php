<?php

declare(strict_types=1);

namespace App\Auth\Events;

final class UserLogin
{
    public function __construct(public readonly string $hash)
    {

    }
}
