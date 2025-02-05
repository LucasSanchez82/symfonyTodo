<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250205102937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE todo ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE todo ADD CONSTRAINT FK_5A0EB6A012469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5A0EB6A012469DE2 ON todo (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE todo DROP CONSTRAINT FK_5A0EB6A012469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP INDEX IDX_5A0EB6A012469DE2');
        $this->addSql('ALTER TABLE todo DROP category_id');
    }
}
