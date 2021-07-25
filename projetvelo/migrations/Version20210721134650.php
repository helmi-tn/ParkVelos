<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210721134650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE site_circuit (site_id INT NOT NULL, circuit_id INT NOT NULL, INDEX IDX_E881116DF6BD1646 (site_id), INDEX IDX_E881116DCF2182C8 (circuit_id), PRIMARY KEY(site_id, circuit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE site_circuit ADD CONSTRAINT FK_E881116DF6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE site_circuit ADD CONSTRAINT FK_E881116DCF2182C8 FOREIGN KEY (circuit_id) REFERENCES circuit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E4CF2182C8');
        $this->addSql('DROP INDEX IDX_694309E4CF2182C8 ON site');
        $this->addSql('ALTER TABLE site DROP circuit_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE site_circuit');
        $this->addSql('ALTER TABLE site ADD circuit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E4CF2182C8 FOREIGN KEY (circuit_id) REFERENCES circuit (id)');
        $this->addSql('CREATE INDEX IDX_694309E4CF2182C8 ON site (circuit_id)');
    }
}
