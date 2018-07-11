<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180711091539 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE annonce ADD author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F65593E5F675F31B ON annonce (author_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6494C2885D7');
        $this->addSql('DROP INDEX IDX_8D93D6494C2885D7 ON user');
        $this->addSql('ALTER TABLE user DROP annonces_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5F675F31B');
        $this->addSql('DROP INDEX IDX_F65593E5F675F31B ON annonce');
        $this->addSql('ALTER TABLE annonce DROP author_id');
        $this->addSql('ALTER TABLE user ADD annonces_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6494C2885D7 FOREIGN KEY (annonces_id) REFERENCES annonce (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6494C2885D7 ON user (annonces_id)');
    }
}
