<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210814095200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_participant (commande_id INT NOT NULL, participant_id INT NOT NULL, INDEX IDX_9E6EEE7082EA2E54 (commande_id), INDEX IDX_9E6EEE709D1C3019 (participant_id), PRIMARY KEY(commande_id, participant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_participant ADD CONSTRAINT FK_9E6EEE7082EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_participant ADD CONSTRAINT FK_9E6EEE709D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE velo DROP FOREIGN KEY FK_354971F59D1C3019');
        $this->addSql('ALTER TABLE velo ADD CONSTRAINT FK_354971F59D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commande_participant');
        $this->addSql('ALTER TABLE velo DROP FOREIGN KEY FK_354971F59D1C3019');
        $this->addSql('ALTER TABLE velo ADD CONSTRAINT FK_354971F59D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id)');
    }
}
