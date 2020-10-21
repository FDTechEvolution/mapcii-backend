<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PackageLinesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PackageLinesTable Test Case
 */
class PackageLinesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PackageLinesTable
     */
    public $PackageLines;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.package_lines',
        'app.packages',
        'app.package_durations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PackageLines') ? [] : ['className' => PackageLinesTable::class];
        $this->PackageLines = TableRegistry::getTableLocator()->get('PackageLines', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PackageLines);

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
