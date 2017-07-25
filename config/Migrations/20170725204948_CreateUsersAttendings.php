<?php
use Migrations\AbstractMigration;
use Cake\Log\Log;

/**
 * Class CreateUsersAttendings
 */
class CreateUsersAttendings extends AbstractMigration
{
    /**
     * Creating table Users Attending
     */
    public function up()
    {
        $table = $this->table('users_attendings');

        if (!$table->exists()) {

            $table
                ->addPrimaryKey('id')
                ->addColumn('user_id', 'integer', ['null' => false])
                ->addColumn('attending_date', 'date', ['null' => false])
                ->addColumn('attending_time_id', 'integer', ['null' => false])
                ->addTimestamps()
                ->create();

            $table
                ->addForeignKey('user_id', 'users', 'id')
                ->update();

            return Log::info('Table users_attending has been created');
        }

        return Log::warning('Failed to create Table users_attending');
    }

    /**
     *  Dropping Table Users Attendings
     */
    public function down()
    {
        $table = $this->table('users_attendings');

        if ($table->exists()) {
            $table->drop();

            return Log::info('Table users_attending has been dropped');
        }

        return Log::warning('Table users_attending does not dropped. Dropping has been failed');
    }
}

