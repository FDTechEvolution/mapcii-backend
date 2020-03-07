<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaymentLinesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaymentLinesTable Test Case
 */
class PaymentLinesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PaymentLinesTable
     */
    public $PaymentLines;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.payment_lines',
        'app.payments',
        'app.packages',
        'app.financial_accounts',
        'app.images'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PaymentLines') ? [] : ['className' => PaymentLinesTable::class];
        $this->PaymentLines = TableRegistry::getTableLocator()->get('PaymentLines', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PaymentLines);

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
