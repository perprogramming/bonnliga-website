<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20120318214729 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("RENAME TABLE User TO users;");

    }

    public function down(Schema $schema)
    {
        $this->addSql("RENAME TABLE users TO User;");

    }
}
