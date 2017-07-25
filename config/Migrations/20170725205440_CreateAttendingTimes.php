<?php
use Migrations\AbstractMigration;
use Cake\Log\Log;

/**
 * Class CreateAttendingTimes
 */
class CreateAttendingTimes extends AbstractMigration
{


    /**
     * Creating table Attending Times
     *
     * @return bool
     */
    public function up()
    {
        $table = $this->table('attending_times');

        if (!$table->exists()) {
            $table
                ->addPrimaryKey('id')
                ->addColumn('time', 'char', ['length' => 5, 'null' => false])
                ->addTimestamps()
                ->create();

            $this->table('users_attendings')
                ->addForeignKey('attending_time_id', 'attending_times', 'id')
                ->update();

            return Log::info('Table attending_times has been created');
        }

        return Log::warning('Table attending_times failed to create');
    }

    /**
     * Dropping attending times table
     *
     * @return bool
     */
    public function down()
    {
        $table = $this->table('attending_times');

        if ($table->exists()) {
            $table->drop();

            return Log::info('Table attending_times has been dropped');
        }
        return Log::warning('Table attending_times does not dropped. Dropping failed');
    }
}
