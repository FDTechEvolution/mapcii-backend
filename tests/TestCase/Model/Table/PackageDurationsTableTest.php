<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PackageDurationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PackageDurationsTable Test Case
 */
class PackageDurationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PackageDurationsTable
     */
    public $PackageDurations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('PackageDurations') ? [] : ['className' => PackageDurationsTable::class];
        $this->PackageDurations = TableRegistry::getTableLocator()->get('PackageDurations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PackageDurations);

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
