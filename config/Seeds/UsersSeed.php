<?php
use Cake\Core\Configure\Engine\PhpConfig;
use Migrations\AbstractSeed;
use App\Model\Entity\User;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * Class UsersSeed
 */
class UsersSeed extends AbstractSeed
{

    /**
     * @var \App\Model\Table\UsersTable
     */
    protected $_table;

    protected $_data = [];

    public function init()
    {
        $this->_table = TableRegistry::get('users');
        $this->_data = (new PhpConfig(CONFIG . 'Seeds' . DS . 'extra' . DS))->read('users');
    }

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * There is also way to insert bulk Entities via newEntities
     * and to pass array with a Users as a separate array
     * for each user
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        array_map(function ($user) {

            if (!$this->_table->exists($user)) {
                $user = $this->_table->newEntity($user);

                try {
                    $user->set('created_at', Time::now());

                    if ($this->_table->save($user)) {
                        return Log::info(ucfirst($user->role) . " `{$user->full_name}` has been created");
                    }
                } catch (Exception $exception) {

                    return Log::error("Failed to create `{$user->full_name}`s account");
                }
            }

            return Log::error(ucfirst($user->role) . " `{$user->full_name}` already exists");
        }, $this->_data);
    }
}
