<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240223074718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F6E098B10 FOREIGN KEY (activitytype_id) REFERENCES entity (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F1273968F FOREIGN KEY (trader_id) REFERENCES trader (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADCF781577 FOREIGN KEY (categoryproduct_id) REFERENCES categoryproduct (id)');
        $this->addSql('ALTER TABLE trader ADD CONSTRAINT FK_C8A621B36E098B10 FOREIGN KEY (activitytype_id) REFERENCES entity (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F6E098B10');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F4584665A');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F1273968F');
        $this->addSql('ALTER TABLE trader DROP FOREIGN KEY FK_C8A621B36E098B10');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADCF781577');
    }
}
