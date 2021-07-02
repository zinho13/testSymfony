<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210701205402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE code_postals (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dirigeants (id INT AUTO_INCREMENT NOT NULL, nom_dirigeant VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, sexe INT NOT NULL, adresse_mail VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE societes (id INT AUTO_INCREMENT NOT NULL, ville_id INT DEFAULT NULL, nom_societe VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_AEC76507A73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE societes_type_societes (societes_id INT NOT NULL, type_societes_id INT NOT NULL, INDEX IDX_3D4E61897E841BEA (societes_id), INDEX IDX_3D4E6189359DCC7B (type_societes_id), PRIMARY KEY(societes_id, type_societes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_societes (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE villes (id INT AUTO_INCREMENT NOT NULL, code_postal_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_19209FD8B2B59251 (code_postal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE societes ADD CONSTRAINT FK_AEC76507A73F0036 FOREIGN KEY (ville_id) REFERENCES villes (id)');
        $this->addSql('ALTER TABLE societes_type_societes ADD CONSTRAINT FK_3D4E61897E841BEA FOREIGN KEY (societes_id) REFERENCES societes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE societes_type_societes ADD CONSTRAINT FK_3D4E6189359DCC7B FOREIGN KEY (type_societes_id) REFERENCES type_societes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE villes ADD CONSTRAINT FK_19209FD8B2B59251 FOREIGN KEY (code_postal_id) REFERENCES code_postals (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE villes DROP FOREIGN KEY FK_19209FD8B2B59251');
        $this->addSql('ALTER TABLE societes_type_societes DROP FOREIGN KEY FK_3D4E61897E841BEA');
        $this->addSql('ALTER TABLE societes_type_societes DROP FOREIGN KEY FK_3D4E6189359DCC7B');
        $this->addSql('ALTER TABLE societes DROP FOREIGN KEY FK_AEC76507A73F0036');
        $this->addSql('DROP TABLE code_postals');
        $this->addSql('DROP TABLE dirigeants');
        $this->addSql('DROP TABLE societes');
        $this->addSql('DROP TABLE societes_type_societes');
        $this->addSql('DROP TABLE type_societes');
        $this->addSql('DROP TABLE villes');
    }
}
