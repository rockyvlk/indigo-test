<?php

declare(strict_types=1);

namespace App\Auth\Domain\User;

use Webmozart\Assert\Assert;

final class Name
{
    public function __construct(
        public readonly string $firstName,
        public readonly  string $secondName,
    )
    {
        Assert::notEmpty($this->firstName);
        Assert::notEmpty($this->secondName);
    }
}
