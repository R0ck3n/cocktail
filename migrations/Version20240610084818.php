<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240610084818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cocktail_ingredient (cocktail_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_1A2C0A39CD6F76C6 (cocktail_id), INDEX IDX_1A2C0A39933FE08C (ingredient_id), PRIMARY KEY(cocktail_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cocktail_ingredient ADD CONSTRAINT FK_1A2C0A39CD6F76C6 FOREIGN KEY (cocktail_id) REFERENCES cocktail (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cocktail_ingredient ADD CONSTRAINT FK_1A2C0A39933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cocktail_ingredient DROP FOREIGN KEY FK_1A2C0A39CD6F76C6');
        $this->addSql('ALTER TABLE cocktail_ingredient DROP FOREIGN KEY FK_1A2C0A39933FE08C');
        $this->addSql('DROP TABLE cocktail_ingredient');
    }
}
