<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220203094827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE books_clients (books_id INT NOT NULL, clients_id INT NOT NULL, INDEX IDX_9BAA8E77DD8AC20 (books_id), INDEX IDX_9BAA8E7AB014612 (clients_id), PRIMARY KEY(books_id, clients_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE books_clients ADD CONSTRAINT FK_9BAA8E77DD8AC20 FOREIGN KEY (books_id) REFERENCES books (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE books_clients ADD CONSTRAINT FK_9BAA8E7AB014612 FOREIGN KEY (clients_id) REFERENCES clients (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE books_clients');
        $this->addSql('ALTER TABLE books CHANGE title title VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE author author VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE summary summary VARCHAR(1000) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE category category VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE clients CHANGE first_name first_name VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE last_name last_name VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE adress adress VARCHAR(95) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE city city VARCHAR(35) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE mail mail VARCHAR(62) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE phone phone VARCHAR(15) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
    }
}
