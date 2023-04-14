<?php

declare(strict_types=1);

namespace App\Auth\Domain\User;

use Webmozart\Assert\Assert;

final class Login
{
    public function __construct(
        public readonly string $login,
    )
    {
        Assert::notEmpty($this->login);
    }
}
