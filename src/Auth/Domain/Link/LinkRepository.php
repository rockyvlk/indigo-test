<?php

declare(strict_types=1);

namespace App\Auth\Domain\Link;

use App\Auth\Exceptions\Link\LinkNotFoundException;
use Doctrine\DBAL\Connection;
use DateTimeImmutable;

final class LinkRepository implements LinkRepositoryInterface
{
    public function __construct(
        private readonly Connection $connection
    ) {

    }

    public function get(Id $id): Link
    {
        $linkData = $this->connection->createQueryBuilder()
            ->select(
                'l.id',
                'l.hash',
                'l.type',
                'l.state',
                'l.created_at',
            )
            ->from('auth_links', 'l')
            ->where('l.id = :id')
            ->setParameter('id', (string) $id)
            ->executeQuery()
            ->fetchAssociative();

        if(!$linkData) {
            throw new LinkNotFoundException();
        }

        return new Link(
            new Id($linkData['id']),
            new Hash($linkData['hash']),
            Type::from($linkData['type']),
            State::from($linkData['state']),
            new DateTimeImmutable($linkData['created_at'])
        );
    }

    public function save(Link $link): void
    {
        $sql = 'INSERT INTO auth_links(id, hash, type, state, created_at) values(?,?,?,?,?)
                ON CONFLICT (id)
                DO UPDATE SET
                    hash = EXCLUDED.hash,
                    type = EXCLUDED.type,
                    state = EXCLUDED.state,
                    created_at = EXCLUDED.created_at
        ';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, (string) $link->getId());
        $stmt->bindValue(2, (string) $link->getHash());
        $stmt->bindValue(3, $link->getType()->value);
        $stmt->bindValue(4, $link->getState()->value);
        $stmt->bindValue(5, $link->getCreatedAt()->format('Y-m-d H:i:s'));
        $stmt->executeQuery();
    }
}
