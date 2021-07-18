<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210717110848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categoriesite (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE circuit (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, nom VARCHAR(255) NOT NULL, difficulte VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, attribut INT NOT NULL, image LONGBLOB NOT NULL, trajectoire LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_1325F3A6BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nb_personnes INT NOT NULL, commentaire VARCHAR(255) DEFAULT NULL, date DATE NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, circuit_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, icon LONGBLOB DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, map LONGTEXT NOT NULL, INDEX IDX_694309E4CF2182C8 (circuit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site_categoriesite (site_id INT NOT NULL, categoriesite_id INT NOT NULL, INDEX IDX_583CB9B4F6BD1646 (site_id), INDEX IDX_583CB9B489A85BFC (categoriesite_id), PRIMARY KEY(site_id, categoriesite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taille_velo (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, max INT NOT NULL, min INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE velo (id INT AUTO_INCREMENT NOT NULL, taillevelo_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, reference VARCHAR(255) NOT NULL, image LONGBLOB DEFAULT NULL, disponibilite VARCHAR(255) NOT NULL, INDEX IDX_354971F575D6FA18 (taillevelo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE circuit ADD CONSTRAINT FK_1325F3A6BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E4CF2182C8 FOREIGN KEY (circuit_id) REFERENCES circuit (id)');
        $this->addSql('ALTER TABLE site_categoriesite ADD CONSTRAINT FK_583CB9B4F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE site_categoriesite ADD CONSTRAINT FK_583CB9B489A85BFC FOREIGN KEY (categoriesite_id) REFERENCES categoriesite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE velo ADD CONSTRAINT FK_354971F575D6FA18 FOREIGN KEY (taillevelo_id) REFERENCES taille_velo (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE circuit DROP FOREIGN KEY FK_1325F3A6BCF5E72D');
        $this->addSql('ALTER TABLE site_categoriesite DROP FOREIGN KEY FK_583CB9B489A85BFC');
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E4CF2182C8');
        $this->addSql('ALTER TABLE site_categoriesite DROP FOREIGN KEY FK_583CB9B4F6BD1646');
        $this->addSql('ALTER TABLE velo DROP FOREIGN KEY FK_354971F575D6FA18');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categoriesite');
        $this->addSql('DROP TABLE circuit');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE site');
        $this->addSql('DROP TABLE site_categoriesite');
        $this->addSql('DROP TABLE taille_velo');
        $this->addSql('DROP TABLE velo');
    }
}
