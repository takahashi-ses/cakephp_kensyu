<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BulletinTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BulletinTable Test Case
 */
class BulletinTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BulletinTable
     */
    public $Bulletin;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Bulletin',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Bulletin') ? [] : ['className' => BulletinTable::class];
        $this->Bulletin = TableRegistry::getTableLocator()->get('Bulletin', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Bulletin);

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
