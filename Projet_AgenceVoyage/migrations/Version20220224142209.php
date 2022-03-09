<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220224142209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attraction (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(200) NOT NULL, lieu VARCHAR(200) NOT NULL, description TEXT NOT NULL, image VARCHAR(500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage_organise (id INT AUTO_INCREMENT NOT NULL, attraction_id INT DEFAULT NULL, destination VARCHAR(255) NOT NULL, duree VARCHAR(255) NOT NULL, programme LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, hotel VARCHAR(255) NOT NULL, prix INT NOT NULL, INDEX IDX_22CA7F323C216F9D (attraction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE voyage_organise ADD CONSTRAINT FK_22CA7F323C216F9D FOREIGN KEY (attraction_id) REFERENCES attraction (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voyage_organise DROP FOREIGN KEY FK_22CA7F323C216F9D');
        $this->addSql('DROP TABLE attraction');
        $this->addSql('DROP TABLE voyage_organise');
    }
}
