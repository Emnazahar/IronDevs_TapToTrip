<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220219174428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE voyage_organise (id INT AUTO_INCREMENT NOT NULL, destination VARCHAR(255) NOT NULL, duree VARCHAR(255) NOT NULL, programme LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, hotel VARCHAR(255) NOT NULL, prix INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attraction CHANGE description description TEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE voyage_organise');
        $this->addSql('ALTER TABLE attraction CHANGE nom nom VARCHAR(200) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CHANGE lieu lieu VARCHAR(200) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CHANGE description description VARCHAR(500) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CHANGE image image VARCHAR(500) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`');
    }
}
