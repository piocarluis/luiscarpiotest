<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230628171904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE circle (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(25) NOT NULL, radius DOUBLE PRECISION NOT NULL, circumference DOUBLE PRECISION NOT NULL, surface DOUBLE PRECISION NOT NULL, datetime DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE triangle (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, a DOUBLE PRECISION NOT NULL, b DOUBLE PRECISION NOT NULL, c DOUBLE PRECISION NOT NULL, circumference DOUBLE PRECISION NOT NULL, surface DOUBLE PRECISION NOT NULL, datetime DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE circle');
        $this->addSql('DROP TABLE triangle');
    }
}
