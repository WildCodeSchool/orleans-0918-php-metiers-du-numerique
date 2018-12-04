<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181203160032 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE learning_center (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE learning_center_job (learning_center_id INT NOT NULL, job_id INT NOT NULL, INDEX IDX_8D1881B1A319BE10 (learning_center_id), INDEX IDX_8D1881B1BE04EA9 (job_id), PRIMARY KEY(learning_center_id, job_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE learning_center_job ADD CONSTRAINT FK_8D1881B1A319BE10 FOREIGN KEY (learning_center_id) REFERENCES learning_center (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE learning_center_job ADD CONSTRAINT FK_8D1881B1BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE learning_center_job DROP FOREIGN KEY FK_8D1881B1A319BE10');
        $this->addSql('DROP TABLE learning_center');
        $this->addSql('DROP TABLE learning_center_job');
    }
}
