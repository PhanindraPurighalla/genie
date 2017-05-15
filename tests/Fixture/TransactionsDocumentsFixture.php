<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TransactionsDocumentsFixture
 *
 */
class TransactionsDocumentsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'transaction_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'document_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'document_key' => ['type' => 'index', 'columns' => ['document_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['transaction_id', 'document_id'], 'length' => []],
            'document_key' => ['type' => 'foreign', 'columns' => ['document_id'], 'references' => ['documents', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'transaction_1_key' => ['type' => 'foreign', 'columns' => ['transaction_id'], 'references' => ['transactions', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'transaction_id' => 1,
            'document_id' => 1,
            'created' => '2017-05-15 16:22:14',
            'modified' => '2017-05-15 16:22:14'
        ],
    ];
}
