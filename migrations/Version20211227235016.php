<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211227235016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agency (id INT AUTO_INCREMENT NOT NULL, id_api INT NOT NULL, url VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) DEFAULT NULL, country_code LONGTEXT NOT NULL, abbrev VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, administrator VARCHAR(200) DEFAULT NULL, founding_year VARCHAR(20) DEFAULT NULL, info_url VARCHAR(200) DEFAULT NULL, wiki_url VARCHAR(200) DEFAULT NULL, logo_url VARCHAR(255) DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, nation_url VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_70C0C6E633A13055 (id_api), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE astronaut (id INT AUTO_INCREMENT NOT NULL, agency_id INT DEFAULT NULL, space_station_id INT DEFAULT NULL, id_api INT NOT NULL, url VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, status VARCHAR(255) DEFAULT NULL, date_of_birth DATE NOT NULL, date_of_death DATE DEFAULT NULL, nationality VARCHAR(255) NOT NULL, twitter VARCHAR(255) DEFAULT NULL, instagram VARCHAR(255) DEFAULT NULL, bio LONGTEXT NOT NULL, profile_img VARCHAR(255) DEFAULT NULL, profile_image_thumbnail VARCHAR(255) DEFAULT NULL, wiki VARCHAR(255) DEFAULT NULL, role VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_5DADB6E533A13055 (id_api), INDEX IDX_5DADB6E5CDEADB2A (agency_id), INDEX IDX_5DADB6E52722A664 (space_station_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE docking (id INT AUTO_INCREMENT NOT NULL, space_craft_id INT DEFAULT NULL, space_station_id INT DEFAULT NULL, id_api INT NOT NULL, url VARCHAR(255) NOT NULL, docking DATETIME NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_462C35E533A13055 (id_api), UNIQUE INDEX UNIQ_462C35E590B111B1 (space_craft_id), INDEX IDX_462C35E52722A664 (space_station_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE launch (id INT AUTO_INCREMENT NOT NULL, launch_service_provider_id INT NOT NULL, space_craft_id INT DEFAULT NULL, video_id INT DEFAULT NULL, launcher_id INT NOT NULL, id_api VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, name LONGTEXT NOT NULL, status VARCHAR(255) NOT NULL, window_end DATETIME DEFAULT NULL, window_start DATETIME DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, infographic VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_79B757F533A13055 (id_api), INDEX IDX_79B757F518DA72F7 (launch_service_provider_id), UNIQUE INDEX UNIQ_79B757F590B111B1 (space_craft_id), INDEX IDX_79B757F529C1004E (video_id), INDEX IDX_79B757F52724B909 (launcher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE launch_astronaut (launch_id INT NOT NULL, astronaut_id INT NOT NULL, INDEX IDX_55A436DC75B199CE (launch_id), INDEX IDX_55A436DCD390014D (astronaut_id), PRIMARY KEY(launch_id, astronaut_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE launcher (id INT AUTO_INCREMENT NOT NULL, manufacturer_id INT NOT NULL, id_api INT NOT NULL, url VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, family VARCHAR(255) NOT NULL, full_name VARCHAR(255) NOT NULL, min_stage INT DEFAULT NULL, max_stage INT DEFAULT NULL, length INT DEFAULT NULL, diameter INT DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, info_url VARCHAR(255) DEFAULT NULL, wiki_url VARCHAR(255) DEFAULT NULL, total_launch_count INT NOT NULL, consecutive_successful_launches INT NOT NULL, failed_launch INT NOT NULL, successful_launches VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7B9C351533A13055 (id_api), INDEX IDX_7B9C3515A23B42D (manufacturer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE satellite (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, line1 LONGTEXT NOT NULL, line2 LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE space_craft (id INT AUTO_INCREMENT NOT NULL, space_craft_config_id INT NOT NULL, id_api INT NOT NULL, url VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_F95A56C033A13055 (id_api), INDEX IDX_F95A56C025B001C7 (space_craft_config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE space_craft_config (id INT AUTO_INCREMENT NOT NULL, agency_id INT NOT NULL, id_api INT NOT NULL, url VARCHAR(255) NOT NULL, name VARCHAR(200) NOT NULL, capability LONGTEXT NOT NULL, history LONGTEXT NOT NULL, details LONGTEXT NOT NULL, height INT DEFAULT NULL, diameter INT DEFAULT NULL, crew_capacity INT DEFAULT NULL, pal_load_capacity INT DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, wiki_link VARCHAR(255) DEFAULT NULL, info_link VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_B2BE32D933A13055 (id_api), INDEX IDX_B2BE32D9CDEADB2A (agency_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE space_station (id INT AUTO_INCREMENT NOT NULL, id_api INT NOT NULL, url VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, founded DATE NOT NULL, height INT DEFAULT NULL, width INT DEFAULT NULL, mass INT DEFAULT NULL, volume INT DEFAULT NULL, description LONGTEXT NOT NULL, orbit VARCHAR(255) NOT NULL, onboard_crew INT NOT NULL, image_url VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_1F2D23F933A13055 (id_api), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE space_station_agency (space_station_id INT NOT NULL, agency_id INT NOT NULL, INDEX IDX_C806858B2722A664 (space_station_id), INDEX IDX_C806858BCDEADB2A (agency_id), PRIMARY KEY(space_station_id, agency_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE starlink (id INT NOT NULL, starlink_group_id INT NOT NULL, number INT NOT NULL, INDEX IDX_888949F39D88D3B (starlink_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE starlink_group (id INT AUTO_INCREMENT NOT NULL, epoch DOUBLE PRECISION NOT NULL, epoch_year INT NOT NULL, epoch_day INT NOT NULL, epoch_fod DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, feature_image VARCHAR(255) DEFAULT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE astronaut ADD CONSTRAINT FK_5DADB6E5CDEADB2A FOREIGN KEY (agency_id) REFERENCES agency (id)');
        $this->addSql('ALTER TABLE astronaut ADD CONSTRAINT FK_5DADB6E52722A664 FOREIGN KEY (space_station_id) REFERENCES space_station (id)');
        $this->addSql('ALTER TABLE docking ADD CONSTRAINT FK_462C35E590B111B1 FOREIGN KEY (space_craft_id) REFERENCES space_craft (id)');
        $this->addSql('ALTER TABLE docking ADD CONSTRAINT FK_462C35E52722A664 FOREIGN KEY (space_station_id) REFERENCES space_station (id)');
        $this->addSql('ALTER TABLE launch ADD CONSTRAINT FK_79B757F518DA72F7 FOREIGN KEY (launch_service_provider_id) REFERENCES agency (id)');
        $this->addSql('ALTER TABLE launch ADD CONSTRAINT FK_79B757F590B111B1 FOREIGN KEY (space_craft_id) REFERENCES space_craft (id)');
        $this->addSql('ALTER TABLE launch ADD CONSTRAINT FK_79B757F529C1004E FOREIGN KEY (video_id) REFERENCES video (id)');
        $this->addSql('ALTER TABLE launch ADD CONSTRAINT FK_79B757F52724B909 FOREIGN KEY (launcher_id) REFERENCES launcher (id)');
        $this->addSql('ALTER TABLE launch_astronaut ADD CONSTRAINT FK_55A436DC75B199CE FOREIGN KEY (launch_id) REFERENCES launch (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE launch_astronaut ADD CONSTRAINT FK_55A436DCD390014D FOREIGN KEY (astronaut_id) REFERENCES astronaut (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE launcher ADD CONSTRAINT FK_7B9C3515A23B42D FOREIGN KEY (manufacturer_id) REFERENCES agency (id)');
        $this->addSql('ALTER TABLE space_craft ADD CONSTRAINT FK_F95A56C025B001C7 FOREIGN KEY (space_craft_config_id) REFERENCES space_craft_config (id)');
        $this->addSql('ALTER TABLE space_craft_config ADD CONSTRAINT FK_B2BE32D9CDEADB2A FOREIGN KEY (agency_id) REFERENCES agency (id)');
        $this->addSql('ALTER TABLE space_station_agency ADD CONSTRAINT FK_C806858B2722A664 FOREIGN KEY (space_station_id) REFERENCES space_station (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE space_station_agency ADD CONSTRAINT FK_C806858BCDEADB2A FOREIGN KEY (agency_id) REFERENCES agency (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE starlink ADD CONSTRAINT FK_888949F39D88D3B FOREIGN KEY (starlink_group_id) REFERENCES starlink_group (id)');
        $this->addSql('ALTER TABLE starlink ADD CONSTRAINT FK_888949FBF396750 FOREIGN KEY (id) REFERENCES satellite (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE astronaut DROP FOREIGN KEY FK_5DADB6E5CDEADB2A');
        $this->addSql('ALTER TABLE launch DROP FOREIGN KEY FK_79B757F518DA72F7');
        $this->addSql('ALTER TABLE launcher DROP FOREIGN KEY FK_7B9C3515A23B42D');
        $this->addSql('ALTER TABLE space_craft_config DROP FOREIGN KEY FK_B2BE32D9CDEADB2A');
        $this->addSql('ALTER TABLE space_station_agency DROP FOREIGN KEY FK_C806858BCDEADB2A');
        $this->addSql('ALTER TABLE launch_astronaut DROP FOREIGN KEY FK_55A436DCD390014D');
        $this->addSql('ALTER TABLE launch_astronaut DROP FOREIGN KEY FK_55A436DC75B199CE');
        $this->addSql('ALTER TABLE launch DROP FOREIGN KEY FK_79B757F52724B909');
        $this->addSql('ALTER TABLE starlink DROP FOREIGN KEY FK_888949FBF396750');
        $this->addSql('ALTER TABLE docking DROP FOREIGN KEY FK_462C35E590B111B1');
        $this->addSql('ALTER TABLE launch DROP FOREIGN KEY FK_79B757F590B111B1');
        $this->addSql('ALTER TABLE space_craft DROP FOREIGN KEY FK_F95A56C025B001C7');
        $this->addSql('ALTER TABLE astronaut DROP FOREIGN KEY FK_5DADB6E52722A664');
        $this->addSql('ALTER TABLE docking DROP FOREIGN KEY FK_462C35E52722A664');
        $this->addSql('ALTER TABLE space_station_agency DROP FOREIGN KEY FK_C806858B2722A664');
        $this->addSql('ALTER TABLE starlink DROP FOREIGN KEY FK_888949F39D88D3B');
        $this->addSql('ALTER TABLE launch DROP FOREIGN KEY FK_79B757F529C1004E');
        $this->addSql('DROP TABLE agency');
        $this->addSql('DROP TABLE astronaut');
        $this->addSql('DROP TABLE docking');
        $this->addSql('DROP TABLE launch');
        $this->addSql('DROP TABLE launch_astronaut');
        $this->addSql('DROP TABLE launcher');
        $this->addSql('DROP TABLE satellite');
        $this->addSql('DROP TABLE space_craft');
        $this->addSql('DROP TABLE space_craft_config');
        $this->addSql('DROP TABLE space_station');
        $this->addSql('DROP TABLE space_station_agency');
        $this->addSql('DROP TABLE starlink');
        $this->addSql('DROP TABLE starlink_group');
        $this->addSql('DROP TABLE video');
    }
}
