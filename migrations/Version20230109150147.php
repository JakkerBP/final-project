<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230109150147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E098486F9AC');
        $this->addSql('DROP INDEX UNIQ_81398E098486F9AC ON customer');
        $this->addSql('ALTER TABLE customer DROP adress_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer ADD adress_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E098486F9AC FOREIGN KEY (adress_id) REFERENCES adress (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E098486F9AC ON customer (adress_id)');
    }
}
