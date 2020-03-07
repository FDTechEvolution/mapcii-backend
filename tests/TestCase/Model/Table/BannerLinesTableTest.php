<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BannerLinesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BannerLinesTable Test Case
 */
class BannerLinesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BannerLinesTable
     */
    public $BannerLines;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.banner_lines',
        'app.banners',
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
        $config = TableRegistry::getTableLocator()->exists('BannerLines') ? [] : ['className' => BannerLinesTable::class];
        $this->BannerLines = TableRegistry::getTableLocator()->get('BannerLines', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BannerLines);

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
