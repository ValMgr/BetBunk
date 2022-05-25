<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220512135922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question ADD image_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE question ADD image_size INT NOT NULL');
        $this->addSql('ALTER TABLE quiz ADD thumbnail_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE quiz ADD thumbnail_size INT NOT NULL');
        $this->addSql('ALTER TABLE quiz ADD image_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE quiz ADD image_size INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE quiz DROP thumbnail_name');
        $this->addSql('ALTER TABLE quiz DROP thumbnail_size');
        $this->addSql('ALTER TABLE quiz DROP image_name');
        $this->addSql('ALTER TABLE quiz DROP image_size');
        $this->addSql('ALTER TABLE question DROP image_name');
        $this->addSql('ALTER TABLE question DROP image_size');
    }
}
