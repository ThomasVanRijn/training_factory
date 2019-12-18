<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191218141627 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD firstname VARCHAR(255) NOT NULL, ADD preprovision VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD dateofbirth DATE NOT NULL, ADD gender VARCHAR(255) NOT NULL, ADD hiring_date VARCHAR(255) NOT NULL, ADD salary NUMERIC(10, 2) NOT NULL, ADD street VARCHAR(255) NOT NULL, ADD postal_code VARCHAR(255) NOT NULL, ADD place VARCHAR(255) NOT NULL, CHANGE roles roles JSON NOT NULL, CHANGE first_name username VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD first_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP username, DROP firstname, DROP preprovision, DROP lastname, DROP dateofbirth, DROP gender, DROP hiring_date, DROP salary, DROP street, DROP postal_code, DROP place, CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
