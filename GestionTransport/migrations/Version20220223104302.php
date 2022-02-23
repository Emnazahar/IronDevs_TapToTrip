<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220223104302 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie CHANGE stock stock INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transport ADD idcategorie_id INT DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212EFA5A9824 FOREIGN KEY (idcategorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_66AB212EFA5A9824 ON transport (idcategorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE stock stock INT NOT NULL');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212EFA5A9824');
        $this->addSql('DROP INDEX IDX_66AB212EFA5A9824 ON transport');
        $this->addSql('ALTER TABLE transport DROP idcategorie_id, CHANGE matricule matricule VARCHAR(255) NOT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE marque marque VARCHAR(255) NOT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE modele modele VARCHAR(255) NOT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE image image VARCHAR(500) DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`');
    }
}
