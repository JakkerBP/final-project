<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230117094253 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_custom_key DROP INDEX UNIQ_3F8F2BDA37112802, ADD INDEX IDX_3F8F2BDA37112802 (keyy_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_custom_key DROP INDEX IDX_3F8F2BDA37112802, ADD UNIQUE INDEX UNIQ_3F8F2BDA37112802 (keyy_id)');
    }
}
