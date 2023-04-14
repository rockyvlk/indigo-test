<?php

declare(strict_types=1);

namespace App\Auth\Subscribers;

use App\Auth\Events\HashLinkEvent;
use App\Auth\Events\UserLogin;
use App\Auth\Events\UserRegistered;
use App\Auth\Read\Link\LinkFetcherInterface;
use App\Shared\Command\CommandBusInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Auth\UseCases\ChangeLinkToUsed;

final class InvalidateLinkHashSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
        private readonly LinkFetcherInterface $linkFetcher,
    )
    {

    }

    public static function getSubscribedEvents(): array
    {
        return [
            UserRegistered::class => 'onUserRegistered',
            UserLogin::class => 'onUserLogin',
        ];
    }

    public function onUserRegistered(UserRegistered $event): void
    {
        $this->invalidateHash($event->hash);
    }

    public function onUserLogin(UserLogin $event): void
    {
        $this->invalidateHash($event->hash);
    }

    private function invalidateHash(string $hash): void
    {
        $link = $this->linkFetcher->findByHash($hash);
        $changeLinkToUsed = new ChangeLinkToUsed\Command($link->id);
        $this->commandBus->dispatch($changeLinkToUsed);
    }
}
