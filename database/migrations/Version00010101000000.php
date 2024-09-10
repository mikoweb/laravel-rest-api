<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use LaravelDoctrine\Migrations\Schema\Table;
use LaravelDoctrine\Migrations\Schema\Builder;

class Version00010101000000 extends AbstractMigration
{
    /**
     * Run the migrations.
     */
    public function up(Schema $schema): void
    {
        (new Builder($schema))->create('users', function (Table $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->unique('email');
            $table->timestamp('email_verified_at')->setNotnull(false);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        (new Builder($schema))->create('password_reset_tokens', function (Table $table) {
            $table->string('email');
            $table->primary('email');
            $table->string('token');
            $table->timestamp('created_at')->setNotnull(false);
        });

        (new Builder($schema))->create('sessions', function (Table $table) {
            $table->string('id');
            $table->primary('id');
            $table->integer('user_id', unsigned: true)->setNotnull(false);
            $table->foreign('users', 'user_id');
            $table->string('ip_address', 45)->setNotnull(false);
            $table->text('user_agent')->setNotnull(false);
            $table->text('payload');
            $table->integer('last_activity');
            $table->index(['user_id', 'last_activity']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(Schema $schema): void
    {
        (new Builder($schema))->dropIfExists('users');
        (new Builder($schema))->dropIfExists('password_reset_tokens');
        (new Builder($schema))->dropIfExists('sessions');
    }
}
