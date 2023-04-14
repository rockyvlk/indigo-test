<?php

declare(strict_types=1);

namespace App\Auth\Services\TelegramBot;

interface BotUrlGeneratorInterface
{
    public function generate(): string;
}
