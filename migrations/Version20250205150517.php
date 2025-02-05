<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250205150517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE todo_user (todo_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(todo_id, user_id))');
        $this->addSql('CREATE INDEX IDX_D242B056EA1EBC33 ON todo_user (todo_id)');
        $this->addSql('CREATE INDEX IDX_D242B056A76ED395 ON todo_user (user_id)');
        $this->addSql('ALTER TABLE todo_user ADD CONSTRAINT FK_D242B056EA1EBC33 FOREIGN KEY (todo_id) REFERENCES todo (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE todo_user ADD CONSTRAINT FK_D242B056A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_todo DROP CONSTRAINT fk_208ffa69a76ed395');
        $this->addSql('ALTER TABLE user_todo DROP CONSTRAINT fk_208ffa69ea1ebc33');
        $this->addSql('DROP TABLE user_todo');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE user_todo (user_id INT NOT NULL, todo_id INT NOT NULL, PRIMARY KEY(user_id, todo_id))');
        $this->addSql('CREATE INDEX idx_208ffa69ea1ebc33 ON user_todo (todo_id)');
        $this->addSql('CREATE INDEX idx_208ffa69a76ed395 ON user_todo (user_id)');
        $this->addSql('ALTER TABLE user_todo ADD CONSTRAINT fk_208ffa69a76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_todo ADD CONSTRAINT fk_208ffa69ea1ebc33 FOREIGN KEY (todo_id) REFERENCES todo (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE todo_user DROP CONSTRAINT FK_D242B056EA1EBC33');
        $this->addSql('ALTER TABLE todo_user DROP CONSTRAINT FK_D242B056A76ED395');
        $this->addSql('DROP TABLE todo_user');
    }
}
