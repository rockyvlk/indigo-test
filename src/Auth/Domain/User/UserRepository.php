<?php

declare(strict_types=1);

namespace App\Auth\Domain\User;

use App\Auth\Exceptions\User\UserNotFoundException;
use Doctrine\DBAL\Connection;

final class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private readonly Connection $connection
    ) {

    }

    public function get(Id $id): User
    {
        $userData = $this->connection->createQueryBuilder()
            ->select(
                'u.id',
                'u.first_name',
                'u.second_name',
                'u.login',
                'u.telegram_id',
            )
            ->from('auth_users', 'u')
            ->where('u.id = :id')
            ->setParameter('id', (string) $id)
            ->executeQuery()
            ->fetchAssociative();

        if(!$userData) {
            throw new UserNotFoundException();
        }

        return new User(
            new Id($userData['id']),
            new Name($userData['first_name'], $userData['second_name']),
            new Login($userData['login']),
            new TelegramId($userData['telegram_id']),
        );
    }

    public function save(User $user): void
    {
        $sql = 'INSERT INTO auth_users(id, first_name, second_name, login, telegram_id) values(?,?,?,?,?)
                ON CONFLICT (id)
                DO UPDATE SET
                    first_name = EXCLUDED.first_name,
                    second_name = EXCLUDED.second_name,
                    login = EXCLUDED.login,
                    telegram_id = EXCLUDED.telegram_id;
        ';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, (string) $user->getId());
        $stmt->bindValue(2, $user->getName()->firstName);
        $stmt->bindValue(3, $user->getName()->secondName);
        $stmt->bindValue(4, $user->getLogin()->login);
        $stmt->bindValue(5, $user->getTelegramId()->id);
        $stmt->executeQuery();
    }
}
