<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200728100139 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employe ADD employer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B941CD9E7A FOREIGN KEY (employer_id) REFERENCES employe (id)');
        $this->addSql('CREATE INDEX IDX_F804D3B941CD9E7A ON employe (employer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B941CD9E7A');
        $this->addSql('DROP INDEX IDX_F804D3B941CD9E7A ON employe');
        $this->addSql('ALTER TABLE employe DROP employer_id');
    }
}
