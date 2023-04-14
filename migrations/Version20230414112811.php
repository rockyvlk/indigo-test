<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230414112811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auth_users (id UUID NOT NULL, login VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, second_name VARCHAR(255) NOT NULL, telegram_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE auth_users ADD CONSTRAINT UNIQ_D8A1F49CAA08CB10 UNIQUE (login)');
        $this->addSql('CREATE TABLE auth_links (id UUID NOT NULL, hash VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, state VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE auth_links ADD CONSTRAINT UNIQ_1DA0F06DD1B862B8 UNIQUE (hash)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE auth_users');
        $this->addSql('DROP TABLE auth_links');
    }
}
