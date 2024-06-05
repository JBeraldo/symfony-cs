<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240605000231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE job_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE job (id INT NOT NULL, job_sector_id INT DEFAULT NULL, title VARCHAR(180) NOT NULL, description VARCHAR(180) NOT NULL, experience INT NOT NULL, minimum_salary DOUBLE PRECISION NOT NULL, maximum_salary DOUBLE PRECISION NOT NULL, active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FBD8E0F819252776 ON job (job_sector_id)');
        $this->addSql('CREATE TABLE jobs_skills (skill_id INT NOT NULL, job_id INT NOT NULL, PRIMARY KEY(skill_id, job_id))');
        $this->addSql('CREATE INDEX IDX_183431715585C142 ON jobs_skills (skill_id)');
        $this->addSql('CREATE INDEX IDX_18343171BE04EA9 ON jobs_skills (job_id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F819252776 FOREIGN KEY (job_sector_id) REFERENCES job_sector (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE jobs_skills ADD CONSTRAINT FK_183431715585C142 FOREIGN KEY (skill_id) REFERENCES "skill" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE jobs_skills ADD CONSTRAINT FK_18343171BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE job_id_seq CASCADE');
        $this->addSql('ALTER TABLE job DROP CONSTRAINT FK_FBD8E0F819252776');
        $this->addSql('ALTER TABLE jobs_skills DROP CONSTRAINT FK_183431715585C142');
        $this->addSql('ALTER TABLE jobs_skills DROP CONSTRAINT FK_18343171BE04EA9');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE jobs_skills');
    }
}
