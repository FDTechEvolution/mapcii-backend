<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VisitorCountersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VisitorCountersTable Test Case
 */
class VisitorCountersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VisitorCountersTable
     */
    public $VisitorCounters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.visitor_counters'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('VisitorCounters') ? [] : ['className' => VisitorCountersTable::class];
        $this->VisitorCounters = TableRegistry::getTableLocator()->get('VisitorCounters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VisitorCounters);

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
