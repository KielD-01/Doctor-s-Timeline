<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AttendingTimesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AttendingTimesTable Test Case
 */
class AttendingTimesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AttendingTimesTable
     */
    public $AttendingTimes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.attending_times',
        'app.users_attendings',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AttendingTimes') ? [] : ['className' => AttendingTimesTable::class];
        $this->AttendingTimes = TableRegistry::get('AttendingTimes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AttendingTimes);

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
}
