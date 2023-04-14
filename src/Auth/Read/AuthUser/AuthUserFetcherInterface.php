<?php

declare(strict_types=1);

namespace App\Auth\Read\AuthUser;

interface AuthUserFetcherInterface
{
    public function findByLogin(string $login): ?AuthUser;
}
