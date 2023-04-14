<?php

declare(strict_types=1);

namespace App\Auth\Read\Link;

use DateTimeImmutable;

final class Link
{
    public function __construct(
        public readonly string $id,
        public readonly string $hash,
        public readonly State $state,
        public readonly DateTimeImmutable $date,
    ) {

    }
}
