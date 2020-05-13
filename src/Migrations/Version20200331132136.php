<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200331132136 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, auteur VARCHAR(255) NOT NULL, commentaire VARCHAR(255) DEFAULT NULL, note DOUBLE PRECISION DEFAULT NULL, INDEX IDX_67F068BCA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE lieux ADD commentaire_id INT NOT NULL, ADD adresse VARCHAR(255) NOT NULL, CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE lieux ADD CONSTRAINT FK_9E44A8AEBA9CD190 FOREIGN KEY (commentaire_id) REFERENCES commentaire (id)');
        $this->addSql('CREATE INDEX IDX_9E44A8AEBA9CD190 ON lieux (commentaire_id)');
        $this->addSql('ALTER TABLE foret ADD adresse VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE parc ADD adresse VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE plage ADD adresse VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lieux DROP FOREIGN KEY FK_9E44A8AEBA9CD190');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('ALTER TABLE foret DROP adresse');
        $this->addSql('DROP INDEX IDX_9E44A8AEBA9CD190 ON lieux');
        $this->addSql('ALTER TABLE lieux DROP commentaire_id, DROP adresse, CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE parc DROP adresse');
        $this->addSql('ALTER TABLE plage DROP adresse');
    }
}
