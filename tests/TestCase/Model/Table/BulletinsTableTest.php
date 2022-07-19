<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BulletinsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BulletinsTable Test Case
 */
class BulletinsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BulletinsTable
     */
    public $Bulletins;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Bulletins',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Bulletins') ? [] : ['className' => BulletinsTable::class];
        $this->Bulletins = TableRegistry::getTableLocator()->get('Bulletins', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Bulletins);

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
