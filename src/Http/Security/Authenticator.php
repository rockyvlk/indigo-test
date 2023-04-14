<?php

declare(strict_types=1);

namespace App\Http\Security;

use App\Auth\Services\TelegramBot\BotUrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Throwable;
use Twig\Environment;

final class Authenticator extends AbstractAuthenticator
{
    private const AUTH_PARAM = 'indigo-auth';

    public function __construct(
        private readonly Environment $twig,
        private readonly BotUrlGeneratorInterface $botUrlGenerator,
    )
    {
    }

    public function supports(Request $request): bool
    {
        return true;
    }

    public function authenticate(Request $request): Passport
    {
        try {
            $userLogin = $request->getSession()->get(self::AUTH_PARAM);

            return new SelfValidatingPassport(new UserBadge($userLogin));
        } catch (Throwable) {
            throw new AuthenticationException();
        }
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
    {
        return new Response(
            $this->twig->render('public.html.twig', [
                'bot_url' => $this->botUrlGenerator->generate()
            ]),
            status: Response::HTTP_UNAUTHORIZED
        );
    }
}
