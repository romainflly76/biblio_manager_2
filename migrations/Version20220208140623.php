<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220208140623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE books CHANGE title title VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE author author VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE summary summary VARCHAR(1000) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE category category VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE clients CHANGE first_name first_name VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE last_name last_name VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE adress adress VARCHAR(95) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE city city VARCHAR(35) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE mail mail VARCHAR(62) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE phone phone VARCHAR(15) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
    }
}
