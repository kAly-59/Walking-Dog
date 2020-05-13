<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200429144340 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE camping ADD users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE camping ADD CONSTRAINT FK_81A904E467B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_81A904E467B3B43D ON camping (users_id)');
        $this->addSql('ALTER TABLE restaurant ADD users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123F67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_EB95123F67B3B43D ON restaurant (users_id)');
        $this->addSql('ALTER TABLE veterinaire ADD users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE veterinaire ADD CONSTRAINT FK_E9D962B867B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_E9D962B867B3B43D ON veterinaire (users_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE camping DROP FOREIGN KEY FK_81A904E467B3B43D');
        $this->addSql('DROP INDEX IDX_81A904E467B3B43D ON camping');
        $this->addSql('ALTER TABLE camping DROP users_id');
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123F67B3B43D');
        $this->addSql('DROP INDEX IDX_EB95123F67B3B43D ON restaurant');
        $this->addSql('ALTER TABLE restaurant DROP users_id');
        $this->addSql('ALTER TABLE veterinaire DROP FOREIGN KEY FK_E9D962B867B3B43D');
        $this->addSql('DROP INDEX IDX_E9D962B867B3B43D ON veterinaire');
        $this->addSql('ALTER TABLE veterinaire DROP users_id');
    }
}
