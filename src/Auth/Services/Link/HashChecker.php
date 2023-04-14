<?php

declare(strict_types=1);

namespace App\Auth\Services\Link;

use App\Auth\Read\Link\LinkFetcherInterface;
use App\Auth\Read\Link\State;
use DateTimeImmutable;

final class HashChecker implements HashCheckerInterface
{
    private const EXPIRE_IN_SEC = 1000;

    public function __construct(
        private readonly LinkFetcherInterface $linkFetcher,
    ) {

    }

    public function isValid(string $hash): bool
    {
        $link = $this->linkFetcher->findByHash($hash);

        return
            $link
            && $link->state !== State::Used
            && ((new DateTimeImmutable())->getTimestamp() - $link->date->getTimestamp()) < self::EXPIRE_IN_SEC
        ;
    }
}
