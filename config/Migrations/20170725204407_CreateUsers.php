<?php
use Migrations\AbstractMigration;
use Cake\Log\Log;

/**
 * Class CreateUsers
 */
class CreateUsers extends AbstractMigration
{

    /**
     * Creating Users Table
     *
     * @return bool
     */
    public function up()
    {
        $table = $this->table('users');

        if (!$table->exists()) {

            $table
                ->addPrimaryKey('id')
                ->addColumn('username', 'char', ['length' => 30, 'null' => false])
                ->addColumn('password', 'char', ['length' => 255, 'null' => false])
                ->addColumn('email', 'char', ['length' => 40, 'null' => false])
                ->addColumn('first_name', 'char', ['length' => 80, 'null' => false])
                ->addColumn('last_name', 'char', ['length' => 80, 'null' => false])
                ->addColumn('dob', 'date', ['null' => false])
                ->addColumn('role', 'enum', [
                    'values' => [
                        'doctor', 'patient'
                    ],
                    'default' => 'patient'
                ])
                ->addTimestamps()
                ->create();

            return Log::info('Table Users has been created');
        }

        return Log::warning('Table Users already exists');
    }

    /**
     * Dropping Table Users
     *
     * @return bool
     */
    public function down()
    {
        $table = $this->table('users');

        if ($table->exists()) {
            $table->drop();

            return Log::info('Table Users has been dropped');
        }

        return Log::warning('Table Users does not exists. Dropping has been Failed.');
    }
}
