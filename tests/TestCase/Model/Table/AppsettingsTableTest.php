<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AppsettingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AppsettingsTable Test Case
 */
class AppsettingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AppsettingsTable
     */
    public $Appsettings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.appsettings'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Appsettings') ? [] : ['className' => AppsettingsTable::class];
        $this->Appsettings = TableRegistry::getTableLocator()->get('Appsettings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Appsettings);

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
