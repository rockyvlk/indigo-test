<?php

declare(strict_types=1);

namespace App\Auth\Domain\Link;

use \DateTimeImmutable;

final class Link
{
    public function __construct(
        private Id $id,
        private Hash $hash,
        private Type $type,
        private State $state,
        private DateTimeImmutable $createdAt
    ) {

    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getHash(): Hash
    {
        return $this->hash;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    public function getState(): State
    {
        return $this->state;
    }

    public function changeStateToUsed(): void
    {
        $this->state = State::Used;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
