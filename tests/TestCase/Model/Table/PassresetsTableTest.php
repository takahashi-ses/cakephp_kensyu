<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PassresetsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PassresetsTable Test Case
 */
class PassresetsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PassresetsTable
     */
    public $Passresets;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Passresets',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Passresets') ? [] : ['className' => PassresetsTable::class];
        $this->Passresets = TableRegistry::getTableLocator()->get('Passresets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Passresets);

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
