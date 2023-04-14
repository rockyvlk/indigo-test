<?php

declare(strict_types=1);

namespace App\Http\Api;

use App\Auth\Read\AuthUser\AuthUserFetcherInterface;
use App\Auth\Services\Link\LinkGenerator;
use App\Auth\Services\TelegramBot\MessageSenderInterface;
use App\Http\Response\EmptyResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    path: '/telegram',
    name: 'telegram',
    methods: ['POST']
)]
final class TelegramHook
{
    public function __construct(
        private readonly AuthUserFetcherInterface $authUserFetcher,
        private readonly LinkGenerator $linkGenerator,
        private readonly MessageSenderInterface $messageSender,
    ) {
    }

    public function __invoke(TelegramHookRequest $request): Response
    {
        $user = $this->authUserFetcher->findByLogin($request->message['chat']['username']);

        if($user) {
            $link = $this->linkGenerator->generateAuthorization($user->login);
            $message = sprintf('[Авторизация](%s)', $link);
        } else {
            $link = $this->linkGenerator->generateRegister(
                $request->message['from']['first_name'],
                $request->message['from']['last_name'],
                $request->message['from']['username'],
                $request->message['from']['id'],
            );

            $message = sprintf('[Регистрация](%s)', $link);
        }

        $this->messageSender->send($message, $request->message['from']['id']);

        return new EmptyResponse();
    }
}
