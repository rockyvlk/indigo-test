<?php

declare(strict_types=1);

namespace App\Auth\Services\Link;

interface HashGeneratorInterface
{
    public function generate(): string;
}
