<?php

declare(strict_types=1);

namespace App\Auth\UseCases\CreateLink;

use App\Auth\Domain\Link\Hash;
use App\Auth\Domain\Link\Id;
use App\Auth\Domain\Link\Link;
use App\Auth\Domain\Link\LinkRepositoryInterface;
use App\Auth\Domain\Link\State;
use App\Auth\Domain\Link\Type;
use DateTimeImmutable;

final class Handler
{
    public function __construct(
        private readonly LinkRepositoryInterface $linkRepository,
    ) {
    }

    public function __invoke(Command $command): void
    {
        $link = new Link(
            new Id($command->id),
            new Hash($command->hash),
            Type::from($command->type),
            State::Wait,
            new DateTimeImmutable()
        );

        $this->linkRepository->save($link);
    }
}
