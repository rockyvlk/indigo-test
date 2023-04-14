<?php

declare(strict_types=1);

namespace App\Auth\Read\AuthUser;

final class AuthUser
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $login,
    ) {

    }
}
