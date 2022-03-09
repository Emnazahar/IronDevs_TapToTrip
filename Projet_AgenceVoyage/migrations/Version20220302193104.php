<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220302193104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, attractions_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_E01FBE6A69F373B3 (attractions_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A69F373B3 FOREIGN KEY (attractions_id) REFERENCES attraction (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE images');
        $this->addSql('ALTER TABLE attraction CHANGE nom nom VARCHAR(200) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE lieu lieu VARCHAR(200) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description TEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image image VARCHAR(500) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE voyage_organise CHANGE destination destination VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE duree duree VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE programme programme LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image image VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE hotel hotel VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
