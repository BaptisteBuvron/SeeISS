<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211228001241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE starlink_group ADD year_launch INT NOT NULL, ADD number_launch INT NOT NULL, DROP epoch, DROP epoch_year, DROP epoch_day, DROP epoch_fod');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE starlink_group ADD epoch DOUBLE PRECISION NOT NULL, ADD epoch_year INT NOT NULL, ADD epoch_day INT NOT NULL, ADD epoch_fod DOUBLE PRECISION NOT NULL, DROP year_launch, DROP number_launch');
    }
}
