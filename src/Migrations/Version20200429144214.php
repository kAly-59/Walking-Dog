<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200429144214 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE camping DROP FOREIGN KEY FK_81A904E4A76ED395');
        $this->addSql('DROP INDEX IDX_81A904E4A76ED395 ON camping');
        $this->addSql('ALTER TABLE camping DROP user_id');
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123FA76ED395');
        $this->addSql('DROP INDEX IDX_EB95123FA76ED395 ON restaurant');
        $this->addSql('ALTER TABLE restaurant DROP user_id');
        $this->addSql('ALTER TABLE veterinaire DROP FOREIGN KEY FK_E9D962B8A76ED395');
        $this->addSql('DROP INDEX IDX_E9D962B8A76ED395 ON veterinaire');
        $this->addSql('ALTER TABLE veterinaire DROP user_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE camping ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE camping ADD CONSTRAINT FK_81A904E4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_81A904E4A76ED395 ON camping (user_id)');
        $this->addSql('ALTER TABLE restaurant ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_EB95123FA76ED395 ON restaurant (user_id)');
        $this->addSql('ALTER TABLE veterinaire ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE veterinaire ADD CONSTRAINT FK_E9D962B8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E9D962B8A76ED395 ON veterinaire (user_id)');
    }
}
