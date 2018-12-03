<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181129163711 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE business_job DROP FOREIGN KEY FK_65ABD188A89DB457');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_job (company_id INT NOT NULL, job_id INT NOT NULL, INDEX IDX_FF2B6490979B1AD6 (company_id), INDEX IDX_FF2B6490BE04EA9 (job_id), PRIMARY KEY(company_id, job_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company_job ADD CONSTRAINT FK_FF2B6490979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_job ADD CONSTRAINT FK_FF2B6490BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE business');
        $this->addSql('DROP TABLE business_job');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE company_job DROP FOREIGN KEY FK_FF2B6490979B1AD6');
        $this->addSql('CREATE TABLE business (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, picture VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, mail VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, link VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE business_job (business_id INT NOT NULL, job_id INT NOT NULL, INDEX IDX_65ABD188A89DB457 (business_id), INDEX IDX_65ABD188BE04EA9 (job_id), PRIMARY KEY(business_id, job_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE business_job ADD CONSTRAINT FK_65ABD188A89DB457 FOREIGN KEY (business_id) REFERENCES business (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE business_job ADD CONSTRAINT FK_65ABD188BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE company_job');
    }
}
