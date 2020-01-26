<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SequentNumbersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SequentNumbersTable Test Case
 */
class SequentNumbersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SequentNumbersTable
     */
    public $SequentNumbers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sequent_numbers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SequentNumbers') ? [] : ['className' => SequentNumbersTable::class];
        $this->SequentNumbers = TableRegistry::getTableLocator()->get('SequentNumbers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SequentNumbers);

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
