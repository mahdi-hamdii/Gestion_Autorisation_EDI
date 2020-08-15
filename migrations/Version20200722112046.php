<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200722112046 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE employe (id INT AUTO_INCREMENT NOT NULL, employer_id INT DEFAULT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, email VARCHAR(50) NOT NULL, adresse VARCHAR(100) DEFAULT NULL, telephone VARCHAR(20) DEFAULT NULL, salaire DOUBLE PRECISION NOT NULL, INDEX IDX_F804D3B941CD9E7A (employer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, email VARCHAR(50) NOT NULL, adresse VARCHAR(100) DEFAULT NULL, telephone VARCHAR(20) DEFAULT NULL, salaire DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poste (id INT AUTO_INCREMENT NOT NULL, office VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B941CD9E7A FOREIGN KEY (employer_id) REFERENCES employe (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B941CD9E7A');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE poste');
    }
}
