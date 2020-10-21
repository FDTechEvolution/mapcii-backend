<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssetAdsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssetAdsTable Test Case
 */
class AssetAdsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AssetAdsTable
     */
    public $AssetAds;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.asset_ads',
        'app.assets',
        'app.payments',
        'app.positions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AssetAds') ? [] : ['className' => AssetAdsTable::class];
        $this->AssetAds = TableRegistry::getTableLocator()->get('AssetAds', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssetAds);

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
