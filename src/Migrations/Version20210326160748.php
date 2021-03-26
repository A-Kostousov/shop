<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210326160748 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A12469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
        $this->addSql('DROP INDEX IDX_2D0E4B1612469DE2 ON category_image');
        $this->addSql('ALTER TABLE category_image CHANGE category_id categories_id INT NOT NULL');
        $this->addSql('ALTER TABLE category_image ADD CONSTRAINT FK_2D0E4B16A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_2D0E4B16A21214B7 ON category_image (categories_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category_image DROP FOREIGN KEY FK_2D0E4B16A21214B7');
        $this->addSql('DROP INDEX IDX_2D0E4B16A21214B7 ON category_image');
        $this->addSql('ALTER TABLE category_image CHANGE categories_id category_id INT NOT NULL');
        $this->addSql('CREATE INDEX IDX_2D0E4B1612469DE2 ON category_image (category_id)');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A12469DE2');
    }
}
