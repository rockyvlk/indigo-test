<?php

declare(strict_types=1);

namespace App\Auth\Read\AuthUser;

use Doctrine\DBAL\Connection;

final class AuthUserFetcher implements AuthUserFetcherInterface
{
    public function __construct(private readonly Connection $connection)
    {
    }

    public function findByLogin(string $login): ?AuthUser
    {
        $userData = $this->connection->createQueryBuilder()
            ->select(
                'u.id',
                'u.first_name',
                'u.second_name',
                'u.login',
            )
            ->from('auth_users', 'u')
            ->where('u.login = :login')
            ->setParameter('login', $login)
            ->executeQuery()
            ->fetchAssociative();

        return $userData
            ? new AuthUser(
                $userData['id'],
                $userData['first_name'] . ' ' . $userData['second_name'],
                $userData['login'],
            )
            : null
        ;
    }
}
