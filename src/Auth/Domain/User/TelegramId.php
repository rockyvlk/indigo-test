<?php

declare(strict_types=1);

namespace App\Auth\Domain\User;

use Webmozart\Assert\Assert;

final class TelegramId
{
    public function __construct(
        public readonly int $id,
    )
    {
        Assert::greaterThan($this->id,0);
    }
}
