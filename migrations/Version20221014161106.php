<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221014161106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX `primary` ON student');
        $this->addSql('ALTER TABLE student CHANGE NCS id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE student ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON student');
        $this->addSql('ALTER TABLE student CHANGE id NCS INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE student ADD PRIMARY KEY (NCS)');
    }
}