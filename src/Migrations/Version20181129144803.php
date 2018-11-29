<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181129144803 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, associated_job_id INT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) NOT NULL, job VARCHAR(255) NOT NULL, company VARCHAR(255) DEFAULT NULL, cons_comment LONGTEXT NOT NULL, pros_comment LONGTEXT NOT NULL, comment LONGTEXT DEFAULT NULL, liked INT NOT NULL, accepted TINYINT(1) NOT NULL, post_date DATETIME NOT NULL, INDEX IDX_9474526C43BA71FC (associated_job_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C43BA71FC FOREIGN KEY (associated_job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE partner DROP updated_at');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE comment');
        $this->addSql('ALTER TABLE partner ADD updated_at DATETIME NOT NULL');
    }
}
