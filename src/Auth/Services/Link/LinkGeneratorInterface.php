<?php

declare(strict_types=1);

namespace App\Auth\Services\Link;

use App\Auth\Domain\Link\Type;
use App\Auth\UseCases\CreateLink;
use App\Shared\Command\CommandBusInterface;
use App\Shared\Domain\Id\UuidGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

interface LinkGeneratorInterface
{
    public function generateRegister(
        string $firstName,
        string $lastName,
        string $login,
        int $telegramId,
    ): string;

    public function generateAuthorization(string $login): string;
}
