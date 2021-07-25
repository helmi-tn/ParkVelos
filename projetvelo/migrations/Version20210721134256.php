<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210721134256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE site_categoriesite');
        $this->addSql('ALTER TABLE site ADD categoriesite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E489A85BFC FOREIGN KEY (categoriesite_id) REFERENCES categoriesite (id)');
        $this->addSql('CREATE INDEX IDX_694309E489A85BFC ON site (categoriesite_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE site_categoriesite (site_id INT NOT NULL, categoriesite_id INT NOT NULL, INDEX IDX_583CB9B4F6BD1646 (site_id), INDEX IDX_583CB9B489A85BFC (categoriesite_id), PRIMARY KEY(site_id, categoriesite_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE site_categoriesite ADD CONSTRAINT FK_583CB9B489A85BFC FOREIGN KEY (categoriesite_id) REFERENCES categoriesite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE site_categoriesite ADD CONSTRAINT FK_583CB9B4F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E489A85BFC');
        $this->addSql('DROP INDEX IDX_694309E489A85BFC ON site');
        $this->addSql('ALTER TABLE site DROP categoriesite_id');
    }
}
