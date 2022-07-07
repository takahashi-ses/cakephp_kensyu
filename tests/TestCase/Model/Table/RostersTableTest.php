<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RostersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RostersTable Test Case
 */
class RostersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RostersTable
     */
    public $Rosters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Rosters',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Rosters') ? [] : ['className' => RostersTable::class];
        $this->Rosters = TableRegistry::getTableLocator()->get('Rosters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Rosters);

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
