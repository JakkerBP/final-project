<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230109150050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adress DROP FOREIGN KEY FK_5CECC7BE8BAC62AF');
        $this->addSql('DROP INDEX UNIQ_5CECC7BE8BAC62AF ON adress');
        $this->addSql('ALTER TABLE adress DROP city_id');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B0234AE80F5DF');
        $this->addSql('DROP INDEX IDX_2D5B0234AE80F5DF ON city');
        $this->addSql('ALTER TABLE city DROP department_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adress ADD city_id INT NOT NULL');
        $this->addSql('ALTER TABLE adress ADD CONSTRAINT FK_5CECC7BE8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5CECC7BE8BAC62AF ON adress (city_id)');
        $this->addSql('ALTER TABLE city ADD department_id INT NOT NULL');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('CREATE INDEX IDX_2D5B0234AE80F5DF ON city (department_id)');
    }
}
