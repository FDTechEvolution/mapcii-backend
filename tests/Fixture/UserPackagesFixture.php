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
        'order_code' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'duration' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'credit' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'used' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'start_date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'end_date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'isexpire' => ['type' => 'string', 'length' => null, 'null' => true, 'default' => 'Y', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'status' => ['type' => 'string', 'length' => 2, 'null' => true, 'default' => 'CO', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
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
                'id' => '93be0d4c-0d5a-4d96-93d5-15ed50b77c52',
                'user_id' => '7e11b03a-7b53-4a0c-86ac-9b22dcc4a594',
                'order_code' => 'Lorem ipsum dolor ',
                'duration' => 1,
                'credit' => 1,
                'used' => 1,
                'start_date' => '2020-12-08',
                'end_date' => '2020-12-08',
                'isexpire' => 'Lorem ipsum dolor sit amet',
                'status' => '',
                'created' => '2020-12-08 06:33:47',
                'modified' => '2020-12-08 06:33:47',
                'description' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
