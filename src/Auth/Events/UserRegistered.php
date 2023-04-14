<?php

declare(strict_types=1);

namespace App\Auth\Events;

final class UserRegistered
{
    public function __construct(public readonly string $hash)
    {

    }
}
