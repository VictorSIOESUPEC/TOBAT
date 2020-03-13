<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200306102807 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bateau (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, telephone VARCHAR(255) DEFAULT NULL, code_vip VARCHAR(13) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, profil VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visite (id INT AUTO_INCREMENT NOT NULL, bateau_id INT NOT NULL, heure_debut TIME DEFAULT NULL, heure_fin TIME DEFAULT NULL, nb_places INT DEFAULT NULL, date_visite DATE DEFAULT NULL, INDEX IDX_B09C8CBBA9706509 (bateau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visite_client (visite_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_7CF3A8A4C1C5DC59 (visite_id), INDEX IDX_7CF3A8A419EB6921 (client_id), PRIMARY KEY(visite_id, client_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBBA9706509 FOREIGN KEY (bateau_id) REFERENCES bateau (id)');
        $this->addSql('ALTER TABLE visite_client ADD CONSTRAINT FK_7CF3A8A4C1C5DC59 FOREIGN KEY (visite_id) REFERENCES visite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE visite_client ADD CONSTRAINT FK_7CF3A8A419EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBBA9706509');
        $this->addSql('ALTER TABLE visite_client DROP FOREIGN KEY FK_7CF3A8A419EB6921');
        $this->addSql('ALTER TABLE visite_client DROP FOREIGN KEY FK_7CF3A8A4C1C5DC59');
        $this->addSql('DROP TABLE bateau');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE visite');
        $this->addSql('DROP TABLE visite_client');
    }
}
