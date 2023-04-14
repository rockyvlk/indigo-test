<?php

declare(strict_types=1);

namespace App\Auth\Domain\User;

interface UserRepositoryInterface
{
    public function get(Id $id): User;
    public function save(User $user): void;
}
