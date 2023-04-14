<?php

declare(strict_types=1);

namespace App\Auth\Services\Link;

use DateTimeImmutable;

interface HashCheckerInterface
{
    public function isValid(string $hash): bool;
}
