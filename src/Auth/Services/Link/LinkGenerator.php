<?php

declare(strict_types=1);

namespace App\Auth\Services\Link;

use App\Auth\Domain\Link\Type;
use App\Auth\UseCases\CreateLink;
use App\Shared\Command\CommandBusInterface;
use App\Shared\Domain\Id\UuidGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class LinkGenerator implements LinkGeneratorInterface
{
    public function __construct(
        private readonly UrlGeneratorInterface $urlGenerator,
        private readonly CommandBusInterface $commandBus,
        private readonly HashGeneratorInterface $hashGenerator,
    ) {

    }

    public function generateRegister(
        string $firstName,
        string $lastName,
        string $login,
        int $telegramId,
    ): string {
        $hash = $this->hashGenerator->generate();

        $createLink = new CreateLink\Command(
            UuidGenerator::generate(),
            $hash,
            Type::Register->value
        );
        $this->commandBus->dispatch($createLink);

        return $this->urlGenerator->generate(
            'register',
            [
                'first_name' => $firstName,
                'second_name' => $lastName,
                'login' => $login,
                'telegram_id' => $telegramId,
                'hash' => $hash
            ],
            UrlGeneratorInterface::ABSOLUTE_URL
        );
    }

    public function generateAuthorization(string $login): string
    {
        $hash = $this->hashGenerator->generate();

        $createLink = new CreateLink\Command(
            UuidGenerator::generate(),
            $hash,
            Type::Authorization->value
        );
        $this->commandBus->dispatch($createLink);

        return $this->urlGenerator->generate(
            'login',
            [
                'login' => $login,
                'hash' => $hash
            ],
            UrlGeneratorInterface::ABSOLUTE_URL
        );
    }
}
