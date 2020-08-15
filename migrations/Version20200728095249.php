<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200728095249 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, position VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employe ADD account_id INT DEFAULT NULL, ADD role_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B99B6B5FBA FOREIGN KEY (account_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F804D3B99B6B5FBA ON employe (account_id)');
        $this->addSql('CREATE INDEX IDX_F804D3B9D60322AC ON employe (role_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B9D60322AC');
        $this->addSql('DROP TABLE role');
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B99B6B5FBA');
        $this->addSql('DROP INDEX UNIQ_F804D3B99B6B5FBA ON employe');
        $this->addSql('DROP INDEX IDX_F804D3B9D60322AC ON employe');
        $this->addSql('ALTER TABLE employe DROP account_id, DROP role_id');
    }
}
