<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersAttendingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersAttendingsTable Test Case
 */
class UsersAttendingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersAttendingsTable
     */
    public $UsersAttendings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users_attendings',
        'app.users',
        'app.attending_times'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UsersAttendings') ? [] : ['className' => UsersAttendingsTable::class];
        $this->UsersAttendings = TableRegistry::get('UsersAttendings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersAttendings);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
