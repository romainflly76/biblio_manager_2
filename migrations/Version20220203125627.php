<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220203125627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE borrow (id INT AUTO_INCREMENT NOT NULL, books_id INT DEFAULT NULL, clients_id INT DEFAULT NULL, date_loan DATETIME NOT NULL, date_rendered DATETIME DEFAULT NULL, date_rendred_max DATETIME NOT NULL, INDEX IDX_55DBA8B07DD8AC20 (books_id), INDEX IDX_55DBA8B0AB014612 (clients_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE borrow ADD CONSTRAINT FK_55DBA8B07DD8AC20 FOREIGN KEY (books_id) REFERENCES books (id)');
        $this->addSql('ALTER TABLE borrow ADD CONSTRAINT FK_55DBA8B0AB014612 FOREIGN KEY (clients_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE books_clients DROP FOREIGN KEY FK_9BAA8E77DD8AC20');
        $this->addSql('ALTER TABLE books_clients DROP FOREIGN KEY FK_9BAA8E7AB014612');
        $this->addSql('ALTER TABLE books_clients DROP date_loan, DROP date_rendered, DROP date_rendered_max');
        $this->addSql('ALTER TABLE books_clients ADD CONSTRAINT FK_9BAA8E77DD8AC20 FOREIGN KEY (books_id) REFERENCES books (id)');
        $this->addSql('ALTER TABLE books_clients ADD CONSTRAINT FK_9BAA8E7AB014612 FOREIGN KEY (clients_id) REFERENCES clients (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE borrow');
        $this->addSql('ALTER TABLE books CHANGE title title VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE author author VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE summary summary VARCHAR(1000) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE category category VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE books_clients DROP FOREIGN KEY FK_9BAA8E77DD8AC20');
        $this->addSql('ALTER TABLE books_clients DROP FOREIGN KEY FK_9BAA8E7AB014612');
        $this->addSql('ALTER TABLE books_clients ADD date_loan DATETIME DEFAULT NULL, ADD date_rendered DATETIME DEFAULT NULL, ADD date_rendered_max DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE books_clients ADD CONSTRAINT FK_9BAA8E77DD8AC20 FOREIGN KEY (books_id) REFERENCES books (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE books_clients ADD CONSTRAINT FK_9BAA8E7AB014612 FOREIGN KEY (clients_id) REFERENCES clients (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clients CHANGE first_name first_name VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE last_name last_name VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE adress adress VARCHAR(95) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE city city VARCHAR(35) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE mail mail VARCHAR(62) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE phone phone VARCHAR(15) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
    }
}
