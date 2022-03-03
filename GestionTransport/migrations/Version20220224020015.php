<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220224020015 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212EFA5A9824');
        $this->addSql('ALTER TABLE transport ADD prix DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212EBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE transport RENAME INDEX idx_66ab212efa5a9824 TO IDX_66AB212EBCF5E72D');
        $this->addSql('ALTER TABLE transport RENAME INDEX fk_user TO IDX_66AB212EA76ED395');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212EBCF5E72D');
        $this->addSql('ALTER TABLE transport DROP prix');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212EFA5A9824 FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transport RENAME INDEX idx_66ab212ea76ed395 TO FK_user');
        $this->addSql('ALTER TABLE transport RENAME INDEX idx_66ab212ebcf5e72d TO IDX_66AB212EFA5A9824');
    }
}
