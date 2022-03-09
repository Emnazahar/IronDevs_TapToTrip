<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220309212025 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE transport_user (transport_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_504381CC9909C13F (transport_id), INDEX IDX_504381CCA76ED395 (user_id), PRIMARY KEY(transport_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transport_favori (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transport_user ADD CONSTRAINT FK_504381CC9909C13F FOREIGN KEY (transport_id) REFERENCES transport (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transport_user ADD CONSTRAINT FK_504381CCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compte_bancaire CHANGE numcarte numcarte INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE transport_user');
        $this->addSql('DROP TABLE transport_favori');
        $this->addSql('ALTER TABLE compte_bancaire CHANGE numcarte numcarte VARCHAR(500) NOT NULL');
    }
}
