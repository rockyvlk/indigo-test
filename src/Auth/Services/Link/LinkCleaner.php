<?php

declare(strict_types=1);

namespace App\Auth\Services\Link;

use Doctrine\DBAL\Connection;

final class LinkCleaner implements LinkCleanerInterface
{
    public function __construct(private readonly Connection $connection)
    {

    }

    public function clean(): void
    {
        $sql = 'DELETE FROM auth_links WHERE created_at < NOW() - INTERVAL \'30 days\'';
        $this->connection->executeStatement($sql);
    }
}
