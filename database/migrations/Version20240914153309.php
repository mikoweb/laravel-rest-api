<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240914153309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car_manufacturers (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid_binary)\', name VARCHAR(50) NOT NULL, slug VARCHAR(60) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_3ADEE8E75E237E06 (name), UNIQUE INDEX UNIQ_3ADEE8E7989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE car_regions (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid_binary)\', name VARCHAR(50) NOT NULL, slug VARCHAR(60) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_F1CC822F5E237E06 (name), UNIQUE INDEX UNIQ_F1CC822F989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE car_types (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid_binary)\', name VARCHAR(50) NOT NULL, slug VARCHAR(60) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_869B0CE75E237E06 (name), UNIQUE INDEX UNIQ_869B0CE7989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cars (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid_binary)\', manufacturer_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid_binary)\', type_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid_binary)\', region_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid_binary)\', name VARCHAR(150) NOT NULL, slug VARCHAR(160) NOT NULL, model VARCHAR(100) NOT NULL, drive_train VARCHAR(20) NOT NULL, engine_size NUMERIC(3, 1) NOT NULL, cylinders SMALLINT DEFAULT NULL, horsepower SMALLINT NOT NULL, weight SMALLINT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_95C71D145E237E06 (name), UNIQUE INDEX UNIQ_95C71D14989D9B62 (slug), INDEX IDX_95C71D14A23B42D (manufacturer_id), INDEX IDX_95C71D14C54C8C93 (type_id), INDEX IDX_95C71D1498260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14A23B42D FOREIGN KEY (manufacturer_id) REFERENCES car_manufacturers (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14C54C8C93 FOREIGN KEY (type_id) REFERENCES car_types (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D1498260155 FOREIGN KEY (region_id) REFERENCES car_regions (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14A23B42D');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14C54C8C93');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D1498260155');
        $this->addSql('DROP TABLE car_manufacturers');
        $this->addSql('DROP TABLE car_regions');
        $this->addSql('DROP TABLE car_types');
        $this->addSql('DROP TABLE cars');
    }
}
