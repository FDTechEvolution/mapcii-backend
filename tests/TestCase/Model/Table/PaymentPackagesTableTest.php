<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaymentPackagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaymentPackagesTable Test Case
 */
class PaymentPackagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PaymentPackagesTable
     */
    public $PaymentPackages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.payment_packages',
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
        $config = TableRegistry::getTableLocator()->exists('PaymentPackages') ? [] : ['className' => PaymentPackagesTable::class];
        $this->PaymentPackages = TableRegistry::getTableLocator()->get('PaymentPackages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PaymentPackages);

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
