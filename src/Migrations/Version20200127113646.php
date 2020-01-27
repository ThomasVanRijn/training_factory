<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200127113646 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE lesson (id INT AUTO_INCREMENT NOT NULL, training_id INT DEFAULT NULL, instructeur_id INT DEFAULT NULL, time TIME NOT NULL, date DATE NOT NULL, location VARCHAR(255) NOT NULL, max_persons INT NOT NULL, INDEX IDX_F87474F3BEFD98D1 (training_id), INDEX IDX_F87474F325FCA809 (instructeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, preprovision VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, dateofbirth DATE NOT NULL, gender VARCHAR(255) NOT NULL, emailaddress VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, hiring_date VARCHAR(255) NOT NULL, salary NUMERIC(10, 2) NOT NULL, street VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, place VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE registration (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, lesson_id INT DEFAULT NULL, payment VARCHAR(255) NOT NULL, INDEX IDX_62A8A7A7A76ED395 (user_id), INDEX IDX_62A8A7A7CDF80196 (lesson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, duration TIME NOT NULL, costs INT NOT NULL, brochure_filename VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, loginname VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, preprovision VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) NOT NULL, dateofbirth DATE NOT NULL, gender VARCHAR(255) NOT NULL, hiring_date VARCHAR(255) DEFAULT NULL, salary NUMERIC(10, 2) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(255) DEFAULT NULL, place VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D6496D1A90C6 (loginname), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F3BEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F325FCA809 FOREIGN KEY (instructeur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A7CDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A7CDF80196');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F3BEFD98D1');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F325FCA809');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A7A76ED395');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE registration');
        $this->addSql('DROP TABLE training');
        $this->addSql('DROP TABLE user');
    }
}
