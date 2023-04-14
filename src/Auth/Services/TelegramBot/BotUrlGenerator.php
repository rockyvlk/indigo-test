<?php

declare(strict_types=1);

namespace App\Auth\Services\TelegramBot;

final class BotUrlGenerator implements BotUrlGeneratorInterface
{
    private const LINK_TEMPLATE = 'https://t.me/%s';

    public function __construct(private readonly string $botName)
    {

    }

    public function generate(): string
    {
        return sprintf(self::LINK_TEMPLATE, $this->botName);
    }
}
