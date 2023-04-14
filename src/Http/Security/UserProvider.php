<?php

declare(strict_types=1);

namespace App\Http\Security;

use App\Auth\Read\AuthUser\AuthUserFetcherInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class UserProvider implements UserProviderInterface
{
    public function __construct(
        private readonly AuthUserFetcherInterface $authUserFetcher
    ) {
    }

    public function loadUserByIdentifier(string $identifier): AuthUser
    {
        try {
            $user = $this->authUserFetcher->findByLogin($identifier);

            return new AuthUser(
                $user->id,
                $user->login,
            );
        } catch (\Throwable) {
            throw new UserNotFoundException();
        }
    }

    public function refreshUser(UserInterface $user): AuthUser
    {
        return $this->loadUserByIdentifier($user->getUserIdentifier());
    }

    public function supportsClass(string $class): bool
    {
        return AuthUser::class === $class;
    }
}
