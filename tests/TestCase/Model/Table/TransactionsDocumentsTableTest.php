<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TransactionsDocumentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TransactionsDocumentsTable Test Case
 */
class TransactionsDocumentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TransactionsDocumentsTable
     */
    public $TransactionsDocuments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.transactions_documents',
        'app.transactions',
        'app.users',
        'app.categories',
        'app.transactions_categories',
        'app.documents'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TransactionsDocuments') ? [] : ['className' => 'App\Model\Table\TransactionsDocumentsTable'];
        $this->TransactionsDocuments = TableRegistry::get('TransactionsDocuments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TransactionsDocuments);

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
