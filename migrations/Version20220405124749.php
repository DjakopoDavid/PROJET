<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220405124749 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP INDEX UNIQ_8D93D649AA08CB10');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, security, roles, password FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, security VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, nom VARCHAR(180) NOT NULL, prenom VARCHAR(180) NOT NULL)');
        $this->addSql('INSERT INTO user (id, security, roles, password) SELECT id, security, roles, password FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AA08CB10 ON user (security)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produits (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL COLLATE BINARY, prix_unitaire DOUBLE PRECISION NOT NULL, quantite_stock INTEGER NOT NULL)');
        $this->addSql('DROP INDEX UNIQ_8D93D649AA08CB10');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, security, roles, password FROM "user"');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, security VARCHAR(180) NOT NULL, roles CLOB NOT NULL --
(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO "user" (id, security, roles, password) SELECT id, security, roles, password FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AA08CB10 ON "user" (security)');
    }
}
