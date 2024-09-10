<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use LaravelDoctrine\Migrations\Schema\Table;
use LaravelDoctrine\Migrations\Schema\Builder;

class Version00010101000002 extends AbstractMigration
{
    /**
     * Run the migrations.
     */
    public function up(Schema $schema): void
    {
        (new Builder($schema))->create('jobs', function (Table $table) {
            $table->increments('id');
            $table->string('queue');
            $table->text('payload');
            $table->unsignedSmallInteger('attempts');
            $table->unsignedInteger('reserved_at')->setNotnull(false);
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
            $table->index('queue');
        });

        (new Builder($schema))->create('job_batches', function (Table $table) {
            $table->string('id');
            $table->primary('id');
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->text('failed_job_ids');
            $table->text('options')->setNotnull(false);
            $table->integer('cancelled_at')->setNotnull(false);
            $table->integer('created_at');
            $table->integer('finished_at')->setNotnull(false);
        });

        (new Builder($schema))->create('failed_jobs', function (Table $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->unique('uuid');
            $table->text('connection');
            $table->text('queue');
            $table->text('payload');
            $table->text('exception');
            $table->timestamp('failed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(Schema $schema): void
    {
        (new Builder($schema))->dropIfExists('jobs');
        (new Builder($schema))->dropIfExists('job_batches');
        (new Builder($schema))->dropIfExists('failed_jobs');
    }
}
