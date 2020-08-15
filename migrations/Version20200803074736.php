<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200803074736 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B9D60322AC');
        $this->addSql('DROP INDEX IDX_F804D3B9D60322AC ON employe');
        $this->addSql('ALTER TABLE employe ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', DROP role_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employe ADD role_id INT DEFAULT NULL, DROP roles');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('CREATE INDEX IDX_F804D3B9D60322AC ON employe (role_id)');
    }
}
