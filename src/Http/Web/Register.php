<?php

declare(strict_types=1);

namespace App\Http\Web;

use App\Auth\Events\UserRegistered;
use App\Auth\Services\Link\LinkGenerator;
use App\Auth\UseCases\RegisterUser;
use App\Shared\Command\CommandBusInterface;
use App\Shared\Domain\Id\UuidGenerator;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[
    Route(
        path: '/register',
        name: 'register',
        methods: ['GET']
    ),
]
final class Register
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
        private readonly LinkGenerator $linkGenerator,
        private readonly EventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function __invoke(RegisterRequest $request): Response
    {
        $registerUser = new RegisterUser\Command(
            UuidGenerator::generate(),
            $request->first_name,
            $request->second_name,
            $request->login,
            (int) $request->telegram_id,

        );
        $this->commandBus->dispatch($registerUser);

        $this->eventDispatcher->dispatch(new UserRegistered($request->hash));

        return new RedirectResponse(
            $this->linkGenerator->generateAuthorization($request->login)
        );
    }
}
