<?php

declare(strict_types=1);

namespace App\Shared\Command;

use Symfony\Component\Messenger\MessageBusInterface;

final class CommandBus implements CommandBusInterface
{
    public function __construct(private readonly MessageBusInterface $commandBus)
    {

    }

    public function dispatch(object $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
