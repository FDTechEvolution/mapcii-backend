<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UserPackagesFixture
 *
 */
class UserPackagesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'user_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'package_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'plant' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'start_date' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'end_date' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'isexpire' => ['type' => 'string', 'length' => null, 'null' => true, 'default' => 'N', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ispaid' => ['type' => 'string', 'length' => null, 'null' => true, 'default' => 'N', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'description' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'MyISAM',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => '10bbfe75-721a-408b-bd5d-f46c0c0fe13f',
                'user_id' => 'b3f0fc4e-1e77-41bf-92bb-05155b2c723e',
                'package_id' => '1bfce867-9bb9-4f4b-98a4-a897afb05b87',
                'plant' => 'Lorem ipsum dolor sit amet',
                'start_date' => '2018-09-28 09:32:54',
                'end_date' => '2018-09-28 09:32:54',
                'isexpire' => 'Lorem ipsum dolor sit amet',
                'ispaid' => 'Lorem ipsum dolor sit amet',
                'created' => '2018-09-28 09:32:54',
                'modified' => '2018-09-28 09:32:54',
                'description' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
