<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230116144536 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_custom_key ADD keyy_id INT NOT NULL');
        $this->addSql('ALTER TABLE project_custom_key ADD CONSTRAINT FK_3F8F2BDA37112802 FOREIGN KEY (keyy_id) REFERENCES `key` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3F8F2BDA37112802 ON project_custom_key (keyy_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_custom_key DROP FOREIGN KEY FK_3F8F2BDA37112802');
        $this->addSql('DROP INDEX UNIQ_3F8F2BDA37112802 ON project_custom_key');
        $this->addSql('ALTER TABLE project_custom_key DROP keyy_id');
    }
}
