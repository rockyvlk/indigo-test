<?php

declare(strict_types=1);

namespace App\Http\Security;

use Symfony\Component\Security\Core\User\UserInterface;

final class AuthUser implements UserInterface
{
    public function __construct(
        public readonly string $id,
        public readonly string $login,
    ) {
    }

    public function getUserIdentifier(): string
    {
        return $this->id;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function eraseCredentials()
    {

    }
}
