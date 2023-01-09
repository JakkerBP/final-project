<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230109150720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adress ADD city_id INT NOT NULL');
        $this->addSql('ALTER TABLE adress ADD CONSTRAINT FK_5CECC7BE8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_5CECC7BE8BAC62AF ON adress (city_id)');
        $this->addSql('ALTER TABLE city ADD department_id INT NOT NULL');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('CREATE INDEX IDX_2D5B0234AE80F5DF ON city (department_id)');
        $this->addSql('ALTER TABLE customer ADD adress_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E098486F9AC FOREIGN KEY (adress_id) REFERENCES adress (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E098486F9AC ON customer (adress_id)');
        $this->addSql('ALTER TABLE department ADD country_id INT NOT NULL');
        $this->addSql('ALTER TABLE department ADD CONSTRAINT FK_CD1DE18AF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_CD1DE18AF92F3E70 ON department (country_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adress DROP FOREIGN KEY FK_5CECC7BE8BAC62AF');
        $this->addSql('DROP INDEX IDX_5CECC7BE8BAC62AF ON adress');
        $this->addSql('ALTER TABLE adress DROP city_id');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B0234AE80F5DF');
        $this->addSql('DROP INDEX IDX_2D5B0234AE80F5DF ON city');
        $this->addSql('ALTER TABLE city DROP department_id');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E098486F9AC');
        $this->addSql('DROP INDEX UNIQ_81398E098486F9AC ON customer');
        $this->addSql('ALTER TABLE customer DROP adress_id');
        $this->addSql('ALTER TABLE department DROP FOREIGN KEY FK_CD1DE18AF92F3E70');
        $this->addSql('DROP INDEX IDX_CD1DE18AF92F3E70 ON department');
        $this->addSql('ALTER TABLE department DROP country_id');
    }
}
