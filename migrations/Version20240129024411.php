<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240129024411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Starting the Deputados, Fornecedores and Despesas.';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE deputado (id INT AUTO_INCREMENT NOT NULL, cpf VARCHAR(11) NOT NULL, data_falecimento DATE DEFAULT NULL, data_nascimento DATE NOT NULL, escolaridade VARCHAR(255) DEFAULT NULL, municipio_nascimento VARCHAR(255) NOT NULL, nome_civil VARCHAR(255) NOT NULL, sexo VARCHAR(255) NOT NULL, uf_nascimento VARCHAR(255) NOT NULL, uri VARCHAR(255) DEFAULT NULL, url_website VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE despesa (id INT AUTO_INCREMENT NOT NULL, fornecedor_id INT NOT NULL, deputado_id INT NOT NULL, ano INT NOT NULL, mes INT NOT NULL, data_documento DATE NOT NULL, cod_documento INT NOT NULL, cod_lote INT NOT NULL, cod_tipo_documento INT NOT NULL, num_documento VARCHAR(255) NOT NULL, parcela INT NOT NULL, tipo_documento VARCHAR(255) NOT NULL, tipo_despesa VARCHAR(255) NOT NULL, url_documento VARCHAR(255) NOT NULL, valor_documento DOUBLE PRECISION NOT NULL, valor_glosa DOUBLE PRECISION NOT NULL, valor_liquido DOUBLE PRECISION NOT NULL, INDEX IDX_1F5A61D2D3EBB69D (fornecedor_id), INDEX IDX_1F5A61D2E52FC57E (deputado_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fornecedor (id INT AUTO_INCREMENT NOT NULL, cnpj_cpf_fornecedor VARCHAR(14) NOT NULL, nome_fornecedor VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE despesa ADD CONSTRAINT FK_1F5A61D2D3EBB69D FOREIGN KEY (fornecedor_id) REFERENCES fornecedor (id)');
        $this->addSql('ALTER TABLE despesa ADD CONSTRAINT FK_1F5A61D2E52FC57E FOREIGN KEY (deputado_id) REFERENCES deputado (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE despesa DROP FOREIGN KEY FK_1F5A61D2D3EBB69D');
        $this->addSql('ALTER TABLE despesa DROP FOREIGN KEY FK_1F5A61D2E52FC57E');
        $this->addSql('DROP TABLE deputado');
        $this->addSql('DROP TABLE despesa');
        $this->addSql('DROP TABLE fornecedor');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
