<?php

declare(strict_types=1);

namespace App\Auth\Read\Link;

interface LinkFetcherInterface
{
    public function findByHash(string $hash): ?Link;
}
