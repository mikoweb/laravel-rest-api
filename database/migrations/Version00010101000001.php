<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use LaravelDoctrine\Migrations\Schema\Table;
use LaravelDoctrine\Migrations\Schema\Builder;

class Version00010101000001 extends AbstractMigration
{
    /**
     * Run the migrations.
     */
    public function up(Schema $schema): void
    {
        (new Builder($schema))->create('cache', function (Table $table) {
            $table->string('key');
            $table->primary('key');
            $table->text('value');
            $table->integer('expiration');
        });

        (new Builder($schema))->create('cache_locks', function (Table $table) {
            $table->string('key');
            $table->primary('key');
            $table->string('owner');
            $table->integer('expiration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(Schema $schema): void
    {
        (new Builder($schema))->dropIfExists('cache');
        (new Builder($schema))->dropIfExists('cache_locks');
    }
}
