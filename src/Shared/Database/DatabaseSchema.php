<?php

declare(strict_types=1);

namespace App\Shared\Database;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\Provider\SchemaProvider;

final class DatabaseSchema implements SchemaProvider
{
    public function createSchema(): Schema
    {
        $schema = new Schema();

        $usersTable = $schema->createTable('auth_users');
        $usersTable->addColumn('id', Types::GUID);
        $usersTable->addColumn('login', Types::STRING);
        $usersTable->addColumn('first_name', Types::STRING);
        $usersTable->addColumn('second_name', Types::STRING);
        $usersTable->addColumn('telegram_id', Types::INTEGER);
        $usersTable->addUniqueConstraint(['login']);
        $usersTable->setPrimaryKey(['id']);


        $linksTable = $schema->createTable('auth_links');
        $linksTable->addColumn('id', Types::GUID);
        $linksTable->addColumn('hash', Types::STRING);
        $linksTable->addColumn('type', Types::STRING);
        $linksTable->addColumn('state', Types::STRING);
        $linksTable->addColumn('created_at', Types::DATETIME_IMMUTABLE);
        $linksTable->addUniqueConstraint(['hash']);
        $linksTable->setPrimaryKey(['id']);

        return $schema;
    }
}
