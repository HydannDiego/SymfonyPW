<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221130102929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE administrateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, identifiant VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bien (id INT AUTO_INCREMENT NOT NULL, id_categorie_id INT NOT NULL, titre VARCHAR(60) NOT NULL, description VARCHAR(255) DEFAULT NULL, is_locatif TINYINT(1) NOT NULL, prix INT NOT NULL, ville VARCHAR(100) NOT NULL, cp VARCHAR(5) NOT NULL, surface INT NOT NULL, ref VARCHAR(255) NOT NULL, INDEX IDX_45EDC3869F34925F (id_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_fav (id INT AUTO_INCREMENT NOT NULL, email_user VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_fav_bien (user_fav_id INT NOT NULL, bien_id INT NOT NULL, INDEX IDX_BD7B7F58793BEB46 (user_fav_id), INDEX IDX_BD7B7F58BD95B80F (bien_id), PRIMARY KEY(user_fav_id, bien_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC3869F34925F FOREIGN KEY (id_categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE user_fav_bien ADD CONSTRAINT FK_BD7B7F58793BEB46 FOREIGN KEY (user_fav_id) REFERENCES user_fav (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_fav_bien ADD CONSTRAINT FK_BD7B7F58BD95B80F FOREIGN KEY (bien_id) REFERENCES bien (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC3869F34925F');
        $this->addSql('ALTER TABLE user_fav_bien DROP FOREIGN KEY FK_BD7B7F58793BEB46');
        $this->addSql('ALTER TABLE user_fav_bien DROP FOREIGN KEY FK_BD7B7F58BD95B80F');
        $this->addSql('DROP TABLE administrateur');
        $this->addSql('DROP TABLE bien');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE user_fav');
        $this->addSql('DROP TABLE user_fav_bien');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
