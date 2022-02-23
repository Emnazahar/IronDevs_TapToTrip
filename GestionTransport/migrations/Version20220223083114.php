<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220223083114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transport CHANGE image image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_0900_ai_ci`');
        $this->addSql('ALTER TABLE transport CHANGE matricule matricule VARCHAR(255) NOT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE marque marque VARCHAR(255) NOT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE modele modele VARCHAR(255) NOT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE image image VARCHAR(500) DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`');
    }
}
