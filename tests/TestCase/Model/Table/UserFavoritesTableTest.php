<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserFavoritesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserFavoritesTable Test Case
 */
class UserFavoritesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UserFavoritesTable
     */
    public $UserFavorites;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.user_favorites',
        'app.users',
        'app.assets'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UserFavorites') ? [] : ['className' => UserFavoritesTable::class];
        $this->UserFavorites = TableRegistry::getTableLocator()->get('UserFavorites', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserFavorites);

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
