<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201218132414 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_row DROP FOREIGN KEY FK_B420E5981AD5CDBF');
        $this->addSql('DROP TABLE cart_content');
        $this->addSql('ALTER TABLE cart_row DROP FOREIGN KEY FK_B420E5984584665A');
        $this->addSql('DROP INDEX IDX_B420E5981AD5CDBF ON cart_row');
        $this->addSql('DROP INDEX IDX_B420E5984584665A ON cart_row');
        $this->addSql('ALTER TABLE cart_row DROP cart_id');
        $this->addSql('ALTER TABLE `order` ADD cart LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', CHANGE order_date order_date DATETIME NOT NULL, CHANGE total_price order_price NUMERIC(10, 2) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart_content (id INT AUTO_INCREMENT NOT NULL, cart_order_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_51FF8AE13002253 (cart_order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE cart_content ADD CONSTRAINT FK_51FF8AE13002253 FOREIGN KEY (cart_order_id) REFERENCES `order` (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE cart_row ADD cart_id INT NOT NULL');
        $this->addSql('ALTER TABLE cart_row ADD CONSTRAINT FK_B420E5981AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart_content (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE cart_row ADD CONSTRAINT FK_B420E5984584665A FOREIGN KEY (product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B420E5981AD5CDBF ON cart_row (cart_id)');
        $this->addSql('CREATE INDEX IDX_B420E5984584665A ON cart_row (product_id)');
        $this->addSql('ALTER TABLE `order` DROP cart, CHANGE order_date order_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE order_price total_price NUMERIC(10, 2) NOT NULL');
    }
}
