<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RostersFixture
 */
class RostersFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'users_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '社員ID', 'precision' => null, 'autoIncrement' => null],
        'start_time' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '出勤時間', 'precision' => null],
        'end_time' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '退勤時間', 'precision' => null],
        'status' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => '0', 'comment' => '状態', 'precision' => null, 'autoIncrement' => null],
        'reason' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'collate' => 'utf8mb4_general_ci', 'comment' => '事由', 'precision' => null, 'fixed' => null],
        'deleted' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '削除フラグ', 'precision' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'null' => true, 'default' => 'current_timestamp()', 'comment' => '作成日', 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'null' => true, 'default' => 'current_timestamp()', 'comment' => '更新日', 'precision' => null],
        'created_user' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '作成者', 'precision' => null, 'fixed' => null],
        'modified_user' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '更新者', 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
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
                'id' => 1,
                'users_id' => 1,
                'start_time' => '2022-07-07 00:12:22',
                'end_time' => '2022-07-07 00:12:22',
                'status' => 1,
                'reason' => 'Lorem ipsum dolor sit amet',
                'deleted' => '2022-07-07 00:12:22',
                'created' => 1657152742,
                'modified' => 1657152742,
                'created_user' => 'Lorem ipsum dolor sit amet',
                'modified_user' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
