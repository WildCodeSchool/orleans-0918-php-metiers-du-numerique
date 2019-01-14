<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190111135951 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE learning_center (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, mail VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, accepted TINYINT(1) DEFAULT \'0\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE learning_center_job (learning_center_id INT NOT NULL, job_id INT NOT NULL, INDEX IDX_8D1881B1A319BE10 (learning_center_id), INDEX IDX_8D1881B1BE04EA9 (job_id), PRIMARY KEY(learning_center_id, job_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner (id INT AUTO_INCREMENT NOT NULL, picture VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, associated_job_id INT NOT NULL, picture VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, job VARCHAR(255) NOT NULL, company VARCHAR(255) DEFAULT NULL, cons_comment LONGTEXT NOT NULL, pros_comment LONGTEXT NOT NULL, comment LONGTEXT DEFAULT NULL, liked INT NOT NULL, accepted TINYINT(1) NOT NULL, post_date DATETIME NOT NULL, INDEX IDX_9474526C43BA71FC (associated_job_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, updated_at DATETIME DEFAULT NULL, accepted TINYINT(1) DEFAULT \'0\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_job (company_id INT NOT NULL, job_id INT NOT NULL, INDEX IDX_FF2B6490979B1AD6 (company_id), INDEX IDX_FF2B6490BE04EA9 (job_id), PRIMARY KEY(company_id, job_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D76F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_form (id INT AUTO_INCREMENT NOT NULL, author VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, link VARCHAR(255) DEFAULT NULL, subject VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, associated_category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, video VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, description LONGTEXT NOT NULL, video_description LONGTEXT DEFAULT NULL, video_title VARCHAR(255) DEFAULT NULL, INDEX IDX_FBD8E0F813765BC5 (associated_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE learning_center_job ADD CONSTRAINT FK_8D1881B1A319BE10 FOREIGN KEY (learning_center_id) REFERENCES learning_center (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE learning_center_job ADD CONSTRAINT FK_8D1881B1BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C43BA71FC FOREIGN KEY (associated_job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE company_job ADD CONSTRAINT FK_FF2B6490979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_job ADD CONSTRAINT FK_FF2B6490BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F813765BC5 FOREIGN KEY (associated_category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE learning_center_job DROP FOREIGN KEY FK_8D1881B1A319BE10');
        $this->addSql('ALTER TABLE company_job DROP FOREIGN KEY FK_FF2B6490979B1AD6');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F813765BC5');
        $this->addSql('ALTER TABLE learning_center_job DROP FOREIGN KEY FK_8D1881B1BE04EA9');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C43BA71FC');
        $this->addSql('ALTER TABLE company_job DROP FOREIGN KEY FK_FF2B6490BE04EA9');
        $this->addSql('DROP TABLE learning_center');
        $this->addSql('DROP TABLE learning_center_job');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE company_job');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE contact_form');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE job');
    }
}
