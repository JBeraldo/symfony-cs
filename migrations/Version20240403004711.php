<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240403004711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users_skills (skill_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(skill_id, user_id))');
        $this->addSql('CREATE INDEX IDX_DAD698E05585C142 ON users_skills (skill_id)');
        $this->addSql('CREATE INDEX IDX_DAD698E0A76ED395 ON users_skills (user_id)');
        $this->addSql('ALTER TABLE users_skills ADD CONSTRAINT FK_DAD698E05585C142 FOREIGN KEY (skill_id) REFERENCES "skill" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_skills ADD CONSTRAINT FK_DAD698E0A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE users_skills DROP CONSTRAINT FK_DAD698E05585C142');
        $this->addSql('ALTER TABLE users_skills DROP CONSTRAINT FK_DAD698E0A76ED395');
        $this->addSql('DROP TABLE users_skills');
    }
}
