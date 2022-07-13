<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChatworksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChatworksTable Test Case
 */
class ChatworksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ChatworksTable
     */
    public $Chatworks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Chatworks',
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
        $config = TableRegistry::getTableLocator()->exists('Chatworks') ? [] : ['className' => ChatworksTable::class];
        $this->Chatworks = TableRegistry::getTableLocator()->get('Chatworks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Chatworks);

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
