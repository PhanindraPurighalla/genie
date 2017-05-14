<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TransactionsCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TransactionsCategoriesTable Test Case
 */
class TransactionsCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TransactionsCategoriesTable
     */
    public $TransactionsCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.transactions_categories',
        'app.transactions',
        'app.users',
        'app.categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TransactionsCategories') ? [] : ['className' => 'App\Model\Table\TransactionsCategoriesTable'];
        $this->TransactionsCategories = TableRegistry::get('TransactionsCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TransactionsCategories);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
