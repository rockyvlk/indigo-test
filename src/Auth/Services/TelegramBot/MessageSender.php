<?php

declare(strict_types=1);

namespace App\Auth\Services\TelegramBot;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class MessageSender implements MessageSenderInterface
{
    private const URL = 'https://api.telegram.org/bot';

    public function __construct(
        private readonly string $token,
        private readonly HttpClientInterface $http
    ) {
    }

    public function send(string $message, int $chatId): void
    {
        $params = [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'Markdown',
            'disable_web_page_preview' => true
        ];


        $this->http->request(
            'POST',
            self::URL . $this->token.'/sendMessage',
            [
                'body' => $params,
            ]
        );
    }
}
