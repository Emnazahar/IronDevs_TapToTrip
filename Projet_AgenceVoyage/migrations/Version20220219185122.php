<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220219185122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voyage_organise ADD attraction_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voyage_organise ADD CONSTRAINT FK_22CA7F323C216F9D FOREIGN KEY (attraction_id) REFERENCES attraction (id)');
        $this->addSql('CREATE INDEX IDX_22CA7F323C216F9D ON voyage_organise (attraction_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attraction CHANGE nom nom VARCHAR(200) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CHANGE lieu lieu VARCHAR(200) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CHANGE description description TEXT CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CHANGE image image VARCHAR(500) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE voyage_organise DROP FOREIGN KEY FK_22CA7F323C216F9D');
        $this->addSql('DROP INDEX IDX_22CA7F323C216F9D ON voyage_organise');
        $this->addSql('ALTER TABLE voyage_organise DROP attraction_id, CHANGE destination destination VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE duree duree VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE programme programme LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image image VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE hotel hotel VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
