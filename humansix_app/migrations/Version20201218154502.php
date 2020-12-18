<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201218154502 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_row ADD order_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cart_row ADD CONSTRAINT FK_B420E598FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_B420E598FCDAEAAA ON cart_row (order_id_id)');
        $this->addSql('ALTER TABLE `order` DROP cart');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_row DROP FOREIGN KEY FK_B420E598FCDAEAAA');
        $this->addSql('DROP INDEX IDX_B420E598FCDAEAAA ON cart_row');
        $this->addSql('ALTER TABLE cart_row DROP order_id_id');
        $this->addSql('ALTER TABLE `order` ADD cart LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
    }
}
