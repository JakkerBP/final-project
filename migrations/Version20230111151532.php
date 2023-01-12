<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230111151532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project DROP INDEX UNIQ_2FB3D0EE9395C3F3, ADD INDEX IDX_2FB3D0EE9395C3F3 (customer_id)');
        $this->addSql('ALTER TABLE project CHANGE customer_id customer_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project DROP INDEX IDX_2FB3D0EE9395C3F3, ADD UNIQUE INDEX UNIQ_2FB3D0EE9395C3F3 (customer_id)');
        $this->addSql('ALTER TABLE project CHANGE customer_id customer_id INT DEFAULT NULL');
    }
}
