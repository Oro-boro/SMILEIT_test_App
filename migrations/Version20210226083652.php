<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210226083652 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE devices (ID_Device INT AUTO_INCREMENT NOT NULL, DeviceName VARCHAR(50) NOT NULL, DeviceMac VARCHAR(17) DEFAULT NULL, PRIMARY KEY(ID_Device)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE responses (ID_Response INT AUTO_INCREMENT NOT NULL, ResponseValue INT NOT NULL, ResponseDate DATE NOT NULL, ResponseTime TIME NOT NULL, ID_Device INT DEFAULT NULL, INDEX ID_Device (ID_Device), PRIMARY KEY(ID_Response)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE responses ADD CONSTRAINT FK_315F9F945333E6A0 FOREIGN KEY (ID_Device) REFERENCES devices (ID_Device)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE responses DROP FOREIGN KEY FK_315F9F945333E6A0');
        $this->addSql('DROP TABLE devices');
        $this->addSql('DROP TABLE responses');
    }
}
