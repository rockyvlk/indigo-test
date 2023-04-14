<?php

declare(strict_types=1);

namespace App\Auth\Services\TelegramBot;

interface MessageSenderInterface
{
    public function send(string $message, int $chatId): void;
}
