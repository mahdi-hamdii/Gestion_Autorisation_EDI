<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200724093230 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, user_name VARCHAR(40) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B941CD9E7A');
        $this->addSql('DROP INDEX IDX_F804D3B941CD9E7A ON employe');
        $this->addSql('ALTER TABLE employe DROP employer_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE employe ADD employer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B941CD9E7A FOREIGN KEY (employer_id) REFERENCES employe (id)');
        $this->addSql('CREATE INDEX IDX_F804D3B941CD9E7A ON employe (employer_id)');
    }
}
