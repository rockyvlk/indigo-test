<?php

declare(strict_types=1);

namespace App\Auth\UseCases\CreateLink;

final class Command
{
    public function __construct(
        public readonly string $id,
        public readonly string $hash,
        public readonly string $type,
    ) {
    }
}
