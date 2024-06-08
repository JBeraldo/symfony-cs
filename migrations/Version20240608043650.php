<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240608043650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO job_sector (id,name,description) values (1,'Desenvolvimento de Software', 'Responsável por projetar, desenvolver e manter aplicativos de software.'),(2,'Administração de Redes', 'Responsável por gerenciar e manter redes de computadores dentro de uma organização.'),(3,'Segurança Cibernética', 'Responsável por proteger sistemas de computadores, redes e dados contra ameaças cibernéticas.'),(4,'Administração de Banco de Dados', 'Responsável por gerenciar e manter bancos de dados dentro de uma organização.')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("DELETE FROM job_sector");
    }
}
