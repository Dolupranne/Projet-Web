<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200409141057 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__produit AS SELECT id, reference, descriptif, prix, image FROM produit');
        $this->addSql('DROP TABLE produit');
        $this->addSql('CREATE TABLE produit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, reference VARCHAR(255) NOT NULL COLLATE BINARY, descriptif VARCHAR(255) NOT NULL COLLATE BINARY, prix DOUBLE PRECISION NOT NULL, image VARCHAR(2048) NOT NULL)');
        $this->addSql('INSERT INTO produit (id, reference, descriptif, prix, image) SELECT id, reference, descriptif, prix, image FROM __temp__produit');
        $this->addSql('DROP TABLE __temp__produit');
        $this->addSql('DROP INDEX IDX_8D93D649D60322AC');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, role_id, email, roles, password, pseudo FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, role_id INTEGER NOT NULL, email VARCHAR(180) NOT NULL COLLATE BINARY, roles CLOB NOT NULL COLLATE BINARY --(DC2Type:json)
        , password VARCHAR(255) NOT NULL COLLATE BINARY, pseudo VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user (id, role_id, email, roles, password, pseudo) SELECT id, role_id, email, roles, password, pseudo FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE INDEX IDX_8D93D649D60322AC ON user (role_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('DROP INDEX IDX_26A98456FADC8D36');
        $this->addSql('DROP INDEX IDX_26A98456A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__achat AS SELECT id, user_id, pack_jetons_id, date_achat FROM achat');
        $this->addSql('DROP TABLE achat');
        $this->addSql('CREATE TABLE achat (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, pack_jetons_id INTEGER NOT NULL, date_achat DATETIME NOT NULL, CONSTRAINT FK_26A98456A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_26A98456FADC8D36 FOREIGN KEY (pack_jetons_id) REFERENCES pack_jeton (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO achat (id, user_id, pack_jetons_id, date_achat) SELECT id, user_id, pack_jetons_id, date_achat FROM __temp__achat');
        $this->addSql('DROP TABLE __temp__achat');
        $this->addSql('CREATE INDEX IDX_26A98456FADC8D36 ON achat (pack_jetons_id)');
        $this->addSql('CREATE INDEX IDX_26A98456A76ED395 ON achat (user_id)');
        $this->addSql('DROP INDEX IDX_38D1870FF347EFB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__enchere AS SELECT id, produit_id, date_debut, date_fin FROM enchere');
        $this->addSql('DROP TABLE enchere');
        $this->addSql('CREATE TABLE enchere (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, produit_id INTEGER NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, CONSTRAINT FK_38D1870FF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO enchere (id, produit_id, date_debut, date_fin) SELECT id, produit_id, date_debut, date_fin FROM __temp__enchere');
        $this->addSql('DROP TABLE __temp__enchere');
        $this->addSql('CREATE INDEX IDX_38D1870FF347EFB ON enchere (produit_id)');
        $this->addSql('DROP INDEX IDX_5AC5D870E80B6EFB');
        $this->addSql('DROP INDEX IDX_5AC5D870A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__historique_enchere AS SELECT id, user_id, enchere_id, prix, date_enchere FROM historique_enchere');
        $this->addSql('DROP TABLE historique_enchere');
        $this->addSql('CREATE TABLE historique_enchere (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, enchere_id INTEGER NOT NULL, prix INTEGER NOT NULL, date_enchere DATETIME NOT NULL, CONSTRAINT FK_5AC5D870A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5AC5D870E80B6EFB FOREIGN KEY (enchere_id) REFERENCES enchere (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO historique_enchere (id, user_id, enchere_id, prix, date_enchere) SELECT id, user_id, enchere_id, prix, date_enchere FROM __temp__historique_enchere');
        $this->addSql('DROP TABLE __temp__historique_enchere');
        $this->addSql('CREATE INDEX IDX_5AC5D870E80B6EFB ON historique_enchere (enchere_id)');
        $this->addSql('CREATE INDEX IDX_5AC5D870A76ED395 ON historique_enchere (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_26A98456A76ED395');
        $this->addSql('DROP INDEX IDX_26A98456FADC8D36');
        $this->addSql('CREATE TEMPORARY TABLE __temp__achat AS SELECT id, user_id, pack_jetons_id, date_achat FROM achat');
        $this->addSql('DROP TABLE achat');
        $this->addSql('CREATE TABLE achat (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, pack_jetons_id INTEGER NOT NULL, date_achat DATETIME NOT NULL)');
        $this->addSql('INSERT INTO achat (id, user_id, pack_jetons_id, date_achat) SELECT id, user_id, pack_jetons_id, date_achat FROM __temp__achat');
        $this->addSql('DROP TABLE __temp__achat');
        $this->addSql('CREATE INDEX IDX_26A98456A76ED395 ON achat (user_id)');
        $this->addSql('CREATE INDEX IDX_26A98456FADC8D36 ON achat (pack_jetons_id)');
        $this->addSql('DROP INDEX IDX_38D1870FF347EFB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__enchere AS SELECT id, produit_id, date_debut, date_fin FROM enchere');
        $this->addSql('DROP TABLE enchere');
        $this->addSql('CREATE TABLE enchere (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, produit_id INTEGER NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL)');
        $this->addSql('INSERT INTO enchere (id, produit_id, date_debut, date_fin) SELECT id, produit_id, date_debut, date_fin FROM __temp__enchere');
        $this->addSql('DROP TABLE __temp__enchere');
        $this->addSql('CREATE INDEX IDX_38D1870FF347EFB ON enchere (produit_id)');
        $this->addSql('DROP INDEX IDX_5AC5D870A76ED395');
        $this->addSql('DROP INDEX IDX_5AC5D870E80B6EFB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__historique_enchere AS SELECT id, user_id, enchere_id, prix, date_enchere FROM historique_enchere');
        $this->addSql('DROP TABLE historique_enchere');
        $this->addSql('CREATE TABLE historique_enchere (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, enchere_id INTEGER NOT NULL, prix INTEGER NOT NULL, date_enchere DATETIME NOT NULL)');
        $this->addSql('INSERT INTO historique_enchere (id, user_id, enchere_id, prix, date_enchere) SELECT id, user_id, enchere_id, prix, date_enchere FROM __temp__historique_enchere');
        $this->addSql('DROP TABLE __temp__historique_enchere');
        $this->addSql('CREATE INDEX IDX_5AC5D870A76ED395 ON historique_enchere (user_id)');
        $this->addSql('CREATE INDEX IDX_5AC5D870E80B6EFB ON historique_enchere (enchere_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__produit AS SELECT id, reference, descriptif, prix, image FROM produit');
        $this->addSql('DROP TABLE produit');
        $this->addSql('CREATE TABLE produit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, reference VARCHAR(255) NOT NULL, descriptif VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, image VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO produit (id, reference, descriptif, prix, image) SELECT id, reference, descriptif, prix, image FROM __temp__produit');
        $this->addSql('DROP TABLE __temp__produit');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('DROP INDEX IDX_8D93D649D60322AC');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, role_id, email, roles, password, pseudo FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, role_id INTEGER NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, role_id, email, roles, password, pseudo) SELECT id, role_id, email, roles, password, pseudo FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE INDEX IDX_8D93D649D60322AC ON user (role_id)');
    }
}
