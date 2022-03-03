<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220303020946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE boitevitesse boitevitesse VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE transport CHANGE matricule matricule VARCHAR(255) DEFAULT NULL, CHANGE marque marque VARCHAR(255) DEFAULT NULL, CHANGE modele modele VARCHAR(255) DEFAULT NULL, CHANGE nbsiege nbsiege INT DEFAULT NULL, CHANGE prix prix DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE boitevitesse boitevitesse VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE transport CHANGE matricule matricule VARCHAR(255) NOT NULL, CHANGE marque marque VARCHAR(255) NOT NULL, CHANGE modele modele VARCHAR(255) NOT NULL, CHANGE nbsiege nbsiege INT NOT NULL, CHANGE prix prix DOUBLE PRECISION NOT NULL');
    }
}
