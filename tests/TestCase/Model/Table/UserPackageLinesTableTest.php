<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserPackageLinesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserPackageLinesTable Test Case
 */
class UserPackageLinesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UserPackageLinesTable
     */
    public $UserPackageLines;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.user_package_lines',
        'app.user_packages',
        'app.user_payments'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UserPackageLines') ? [] : ['className' => UserPackageLinesTable::class];
        $this->UserPackageLines = TableRegistry::getTableLocator()->get('UserPackageLines', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserPackageLines);

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
