<?php

declare(strict_types=1);

namespace App\Auth\UseCases\RegisterUser;

use App\Auth\Domain\User\Id;
use App\Auth\Domain\User\Login;
use App\Auth\Domain\User\Name;
use App\Auth\Domain\User\TelegramId;
use App\Auth\Domain\User\User;
use App\Auth\Domain\User\UserRepositoryInterface;

final class Handler
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
//        private LoginExistSpecificationInterface $loginExistSpecification
    ) {
    }

    public function __invoke(Command $command): void
    {
        $user = new User(
            new Id($command->id),
            new Name(
                $command->firstName,
                $command->secondName
            ),
            new Login($command->login),
            new TelegramId($command->telegramId)
        );

        $this->userRepository->save($user);
    }
}
