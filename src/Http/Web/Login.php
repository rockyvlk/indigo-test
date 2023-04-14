<?php

declare(strict_types=1);

namespace App\Http\Web;

use App\Auth\Events\UserLogin;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[
    Route(
        path: '/login',
        name: 'login',
        methods: ['GET']
    ),
]
final class Login
{
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly UrlGeneratorInterface $urlGenerator,
        private readonly EventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function __invoke(LoginRequest $request): Response
    {
        $session = $this->requestStack->getSession();
        $session->set('indigo-auth', $request->login);

        $this->eventDispatcher->dispatch(new UserLogin($request->hash));

        return new RedirectResponse(
            $this->urlGenerator->generate(
                'home',
                [],
                UrlGeneratorInterface::ABSOLUTE_URL
            )
        );
    }
}
