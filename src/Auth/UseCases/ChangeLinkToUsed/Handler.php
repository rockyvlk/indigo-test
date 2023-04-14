<?php

declare(strict_types=1);

namespace App\Auth\UseCases\ChangeLinkToUsed;

use App\Auth\Domain\Link\Id;
use App\Auth\Domain\Link\LinkRepositoryInterface;

final class Handler
{
    public function __construct(
        private readonly LinkRepositoryInterface $linkRepository,
    ) {
    }

    public function __invoke(Command $command): void
    {
        $link = $this->linkRepository->get(new Id($command->id));

        $link->changeStateToUsed();

        $this->linkRepository->save($link);
    }
}
