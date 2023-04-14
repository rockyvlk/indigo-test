<?php

declare(strict_types=1);

namespace App\Auth\Services\Link;

final class HashGenerator implements HashGeneratorInterface
{
    public function generate(): string
    {
        return base64_encode(random_bytes(18));
    }
}
