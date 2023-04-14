<?php

declare(strict_types=1);

namespace App\Auth\UseCases\RegisterUser;

final class Command
{
    public function __construct(
        public readonly string $id,
        public readonly string $firstName,
        public readonly string $secondName,
        public readonly string $login,
        public readonly int $telegramId,
    ) {
    }
}
