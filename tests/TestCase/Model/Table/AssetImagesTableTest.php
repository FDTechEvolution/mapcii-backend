<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssetImagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssetImagesTable Test Case
 */
class AssetImagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AssetImagesTable
     */
    public $AssetImages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.asset_images',
        'app.assets',
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
        $config = TableRegistry::getTableLocator()->exists('AssetImages') ? [] : ['className' => AssetImagesTable::class];
        $this->AssetImages = TableRegistry::getTableLocator()->get('AssetImages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssetImages);

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
