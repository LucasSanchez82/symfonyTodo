<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250205140212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE todo (id SERIAL NOT NULL, category_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, finished BOOLEAN DEFAULT false NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A0EB6A012469DE2 ON todo (category_id)');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, lastname VARCHAR(255) NOT NULL, phone VARCHAR(10) DEFAULT NULL, firstname VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_todo (user_id INT NOT NULL, todo_id INT NOT NULL, PRIMARY KEY(user_id, todo_id))');
        $this->addSql('CREATE INDEX IDX_208FFA69A76ED395 ON user_todo (user_id)');
        $this->addSql('CREATE INDEX IDX_208FFA69EA1EBC33 ON user_todo (todo_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE todo ADD CONSTRAINT FK_5A0EB6A012469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_todo ADD CONSTRAINT FK_208FFA69A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_todo ADD CONSTRAINT FK_208FFA69EA1EBC33 FOREIGN KEY (todo_id) REFERENCES todo (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE todo DROP CONSTRAINT FK_5A0EB6A012469DE2');
        $this->addSql('ALTER TABLE user_todo DROP CONSTRAINT FK_208FFA69A76ED395');
        $this->addSql('ALTER TABLE user_todo DROP CONSTRAINT FK_208FFA69EA1EBC33');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE todo');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_todo');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
