<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200722112517 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employe ADD office_id INT NOT NULL');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9FFA0C224 FOREIGN KEY (office_id) REFERENCES poste (id)');
        $this->addSql('CREATE INDEX IDX_F804D3B9FFA0C224 ON employe (office_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B9FFA0C224');
        $this->addSql('DROP INDEX IDX_F804D3B9FFA0C224 ON employe');
        $this->addSql('ALTER TABLE employe DROP office_id');
    }
}
