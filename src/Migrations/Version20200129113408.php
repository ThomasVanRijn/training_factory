<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200129113408 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE registration CHANGE user_id user_id INT DEFAULT NULL, CHANGE lesson_id lesson_id INT DEFAULT NULL, CHANGE payment payment TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE lesson CHANGE training_id training_id INT DEFAULT NULL, CHANGE instructeur_id instructeur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE preprovision preprovision VARCHAR(255) DEFAULT NULL, CHANGE hiring_date hiring_date VARCHAR(255) DEFAULT NULL, CHANGE salary salary NUMERIC(10, 2) DEFAULT NULL, CHANGE street street VARCHAR(255) DEFAULT NULL, CHANGE postal_code postal_code VARCHAR(255) DEFAULT NULL, CHANGE place place VARCHAR(255) DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lesson CHANGE training_id training_id INT DEFAULT NULL, CHANGE instructeur_id instructeur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE registration CHANGE user_id user_id INT DEFAULT NULL, CHANGE lesson_id lesson_id INT DEFAULT NULL, CHANGE payment payment VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE preprovision preprovision VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE hiring_date hiring_date VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE salary salary NUMERIC(10, 2) DEFAULT \'NULL\', CHANGE street street VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE postal_code postal_code VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE place place VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
