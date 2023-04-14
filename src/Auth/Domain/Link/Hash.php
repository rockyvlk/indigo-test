<?php

declare(strict_types=1);

namespace App\Auth\Domain\Link;

use Webmozart\Assert\Assert;

final class Hash
{
    public function __construct(
        public readonly string $value,
    )
    {
        Assert::notEmpty($this->value);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
