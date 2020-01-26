<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FinancialAccountsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FinancialAccountsTable Test Case
 */
class FinancialAccountsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FinancialAccountsTable
     */
    public $FinancialAccounts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.financial_accounts',
        'app.payments'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FinancialAccounts') ? [] : ['className' => FinancialAccountsTable::class];
        $this->FinancialAccounts = TableRegistry::getTableLocator()->get('FinancialAccounts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FinancialAccounts);

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
