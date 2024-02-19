<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219085638 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE trader (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, lastnameboss VARCHAR(255) NOT NULL, firstnameboss VARCHAR(255) NOT NULL, confirmpassword VARCHAR(500) NOT NULL, phone VARCHAR(255) NOT NULL, compagnyname VARCHAR(255) NOT NULL, siren VARCHAR(255) NOT NULL, adress LONGTEXT NOT NULL, postalcode VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, presentation LONGTEXT NOT NULL, activitytype_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_C8A621B3E7927C74 (email), INDEX IDX_C8A621B36E098B10 (activitytype_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE trader ADD CONSTRAINT FK_C8A621B36E098B10 FOREIGN KEY (activitytype_id) REFERENCES entity (id)');
        $this->addSql('ALTER TABLE image ADD trader_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F6E098B10 FOREIGN KEY (activitytype_id) REFERENCES entity (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F1273968F FOREIGN KEY (trader_id) REFERENCES trader (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F1273968F ON image (trader_id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADCF781577 FOREIGN KEY (categoryproduct_id) REFERENCES categoryproduct (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE trader DROP FOREIGN KEY FK_C8A621B36E098B10');
        $this->addSql('DROP TABLE trader');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F6E098B10');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F4584665A');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F1273968F');
        $this->addSql('DROP INDEX IDX_C53D045F1273968F ON image');
        $this->addSql('ALTER TABLE image DROP trader_id');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADCF781577');
    }
}
