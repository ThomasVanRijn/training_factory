<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191210114127 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lesson ADD location VARCHAR(255) NOT NULL, ADD max_persons INT NOT NULL');
        $this->addSql('ALTER TABLE person ADD role VARCHAR(255) NOT NULL, ADD hiring_date VARCHAR(255) NOT NULL, ADD salary NUMERIC(10, 2) NOT NULL, ADD street VARCHAR(255) NOT NULL, ADD postal_code VARCHAR(255) NOT NULL, ADD place VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lesson DROP location, DROP max_persons');
        $this->addSql('ALTER TABLE person DROP role, DROP hiring_date, DROP salary, DROP street, DROP postal_code, DROP place');
    }
}
