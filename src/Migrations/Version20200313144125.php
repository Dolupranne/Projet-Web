<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200313144125 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__utilisateur AS SELECT id, email, pwd, pseudo FROM utilisateur');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('CREATE TABLE utilisateur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, role_id INTEGER DEFAULT NULL, email VARCHAR(255) NOT NULL COLLATE BINARY, pwd VARCHAR(255) NOT NULL COLLATE BINARY, pseudo VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_1D1C63B3D60322AC FOREIGN KEY (role_id) REFERENCES role (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO utilisateur (id, email, pwd, pseudo) SELECT id, email, pwd, pseudo FROM __temp__utilisateur');
        $this->addSql('DROP TABLE __temp__utilisateur');
        $this->addSql('CREATE INDEX IDX_1D1C63B3D60322AC ON utilisateur (role_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_1D1C63B3D60322AC');
        $this->addSql('CREATE TEMPORARY TABLE __temp__utilisateur AS SELECT id, email, pwd, pseudo FROM utilisateur');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('CREATE TABLE utilisateur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) NOT NULL, pwd VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO utilisateur (id, email, pwd, pseudo) SELECT id, email, pwd, pseudo FROM __temp__utilisateur');
        $this->addSql('DROP TABLE __temp__utilisateur');
    }
}
