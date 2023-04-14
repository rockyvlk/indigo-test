<?php

declare(strict_types=1);

namespace App\Auth\Read\Link;

use Doctrine\DBAL\Connection;

use DateTimeImmutable;

final class LinkFetcher implements LinkFetcherInterface
{
    public function __construct(private readonly Connection $connection)
    {
    }

    public function findByHash(string $hash): ?Link
    {
        $linkData = $this->connection->createQueryBuilder()
            ->select(
                'l.id',
                'l.hash',
                'l.state',
                'l.created_at',
            )
            ->from('auth_links', 'l')
            ->where('l.hash = :hash')
            ->setParameter('hash', $hash)
            ->executeQuery()
            ->fetchAssociative();

        return $linkData
            ? new Link(
                $linkData['id'],
                $linkData['hash'],
                State::from($linkData['state']),
                new DateTimeImmutable($linkData['created_at']),
            )
            : null
        ;
    }
}
