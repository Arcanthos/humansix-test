<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201218160305 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_row DROP FOREIGN KEY FK_B420E598FCDAEAAA');
        $this->addSql('DROP INDEX IDX_B420E598FCDAEAAA ON cart_row');
        $this->addSql('ALTER TABLE cart_row CHANGE order_id_id related_order_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cart_row ADD CONSTRAINT FK_B420E5982B1C2395 FOREIGN KEY (related_order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_B420E5982B1C2395 ON cart_row (related_order_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_row DROP FOREIGN KEY FK_B420E5982B1C2395');
        $this->addSql('DROP INDEX IDX_B420E5982B1C2395 ON cart_row');
        $this->addSql('ALTER TABLE cart_row CHANGE related_order_id order_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cart_row ADD CONSTRAINT FK_B420E598FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B420E598FCDAEAAA ON cart_row (order_id_id)');
    }
}
