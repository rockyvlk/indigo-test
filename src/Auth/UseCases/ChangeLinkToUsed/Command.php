<?php

declare(strict_types=1);

namespace App\Auth\UseCases\ChangeLinkToUsed;

final class Command
{
    public function __construct(
        public readonly string $id,
    ) {
    }
}
