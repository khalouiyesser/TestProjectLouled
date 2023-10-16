<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231016102608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car ADD showroom_id INT NOT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D2243B88B FOREIGN KEY (showroom_id) REFERENCES showroom (id)');
        $this->addSql('CREATE INDEX IDX_773DE69D2243B88B ON car (showroom_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D2243B88B');
        $this->addSql('DROP INDEX IDX_773DE69D2243B88B ON car');
        $this->addSql('ALTER TABLE car DROP showroom_id');
    }
}
