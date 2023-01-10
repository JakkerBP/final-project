<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230110141107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project_key_category (project_id INT NOT NULL, key_category_id INT NOT NULL, INDEX IDX_EDE8362D166D1F9C (project_id), INDEX IDX_EDE8362D49289EA1 (key_category_id), PRIMARY KEY(project_id, key_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project_key_category ADD CONSTRAINT FK_EDE8362D166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_key_category ADD CONSTRAINT FK_EDE8362D49289EA1 FOREIGN KEY (key_category_id) REFERENCES key_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E09A76ED395 ON customer (user_id)');
        $this->addSql('ALTER TABLE `key` ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE `key` ADD CONSTRAINT FK_8A90ABA912469DE2 FOREIGN KEY (category_id) REFERENCES key_category (id)');
        $this->addSql('CREATE INDEX IDX_8A90ABA912469DE2 ON `key` (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_key_category DROP FOREIGN KEY FK_EDE8362D166D1F9C');
        $this->addSql('ALTER TABLE project_key_category DROP FOREIGN KEY FK_EDE8362D49289EA1');
        $this->addSql('DROP TABLE project_key_category');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09A76ED395');
        $this->addSql('DROP INDEX UNIQ_81398E09A76ED395 ON customer');
        $this->addSql('ALTER TABLE customer DROP user_id');
        $this->addSql('ALTER TABLE `key` DROP FOREIGN KEY FK_8A90ABA912469DE2');
        $this->addSql('DROP INDEX IDX_8A90ABA912469DE2 ON `key`');
        $this->addSql('ALTER TABLE `key` DROP category_id');
    }
}
