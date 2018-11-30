<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181128173743 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment ADD cons_comment LONGTEXT NOT NULL, ADD pros_comment LONGTEXT NOT NULL, DROP plus_comment, DROP less_comment, CHANGE liked liked INT NOT NULL, CHANGE business company VARCHAR(255) DEFAULT NULL, CHANGE various_comment comment LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment ADD plus_comment LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, ADD less_comment LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, DROP cons_comment, DROP pros_comment, CHANGE liked liked TINYINT(1) NOT NULL, CHANGE company business VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE comment various_comment LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
