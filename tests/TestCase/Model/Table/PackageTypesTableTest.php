<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PackageTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PackageTypesTable Test Case
 */
class PackageTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PackageTypesTable
     */
    public $PackageTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.package_types',
        'app.packages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PackageTypes') ? [] : ['className' => PackageTypesTable::class];
        $this->PackageTypes = TableRegistry::getTableLocator()->get('PackageTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PackageTypes);

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
