<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181204093310 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE learning_center ADD accepted TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE partner DROP updated_at');
        $this->addSql('ALTER TABLE company_job ADD CONSTRAINT FK_FF2B6490979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE company_job DROP FOREIGN KEY FK_FF2B6490979B1AD6');
        $this->addSql('ALTER TABLE learning_center DROP accepted');
        $this->addSql('ALTER TABLE partner ADD updated_at DATETIME NOT NULL');
    }
}
