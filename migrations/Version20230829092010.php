<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230829092010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE car');
        $this->addSql('ALTER TABLE books CHANGE update_at update_at DATE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, brand TINYTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, model TINYTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, registration TINYTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, fuel TINYTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, price INT NOT NULL, kind TINYTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, reserved TINYTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, updated_at DATETIME DEFAULT \'NULL\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE books CHANGE update_at update_at DATE DEFAULT \'NULL\'');
    }
}
