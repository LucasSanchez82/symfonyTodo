<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250205105252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, lastname VARCHAR(255) NOT NULL, phone VARCHAR(10) DEFAULT NULL, firstname VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_todo (user_id INT NOT NULL, todo_id INT NOT NULL, PRIMARY KEY(user_id, todo_id))');
        $this->addSql('CREATE INDEX IDX_208FFA69A76ED395 ON user_todo (user_id)');
        $this->addSql('CREATE INDEX IDX_208FFA69EA1EBC33 ON user_todo (todo_id)');
        $this->addSql('ALTER TABLE user_todo ADD CONSTRAINT FK_208FFA69A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_todo ADD CONSTRAINT FK_208FFA69EA1EBC33 FOREIGN KEY (todo_id) REFERENCES todo (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_todo DROP CONSTRAINT FK_208FFA69A76ED395');
        $this->addSql('ALTER TABLE user_todo DROP CONSTRAINT FK_208FFA69EA1EBC33');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_todo');
    }
}
