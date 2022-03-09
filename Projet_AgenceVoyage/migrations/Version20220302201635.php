<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220302201635 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attraction DROP image');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attraction ADD image VARCHAR(500) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nom nom VARCHAR(200) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE lieu lieu VARCHAR(200) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description TEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE images CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE voyage_organise CHANGE destination destination VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE duree duree VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE programme programme LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image image VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE hotel hotel VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
