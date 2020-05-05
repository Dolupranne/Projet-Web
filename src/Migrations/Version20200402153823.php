<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200402153823 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE achat (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date_achat DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE enchere (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE historique_enchere (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, prix INTEGER NOT NULL, date_enchere DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE pack_jeton (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nbjetons INTEGER NOT NULL, description VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE TABLE produit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, reference VARCHAR(255) NOT NULL, descriptif VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, image VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE role (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, niveau INTEGER NOT NULL, description VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE achat');
        $this->addSql('DROP TABLE enchere');
        $this->addSql('DROP TABLE historique_enchere');
        $this->addSql('DROP TABLE pack_jeton');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE user');
    }
}
