<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssetCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssetCategoriesTable Test Case
 */
class AssetCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AssetCategoriesTable
     */
    public $AssetCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.asset_categories',
        'app.asset_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AssetCategories') ? [] : ['className' => AssetCategoriesTable::class];
        $this->AssetCategories = TableRegistry::getTableLocator()->get('AssetCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssetCategories);

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
