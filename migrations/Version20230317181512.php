<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230317181512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE course ADD user_creator_id INT NOT NULL');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB9C645C84A FOREIGN KEY (user_creator_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_169E6FB9C645C84A ON course (user_creator_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB9C645C84A');
        $this->addSql('DROP INDEX IDX_169E6FB9C645C84A ON course');
        $this->addSql('ALTER TABLE course DROP user_creator_id');
    }
}
