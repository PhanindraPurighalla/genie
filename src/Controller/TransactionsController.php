<?php
namespace App\Controller;

use App\Controller\AppController;

require_once __DIR__ . '/../../vendor/autoload.php';
use TesseractOCR;

/**
 * Transactions Controller
 *
 * @property \App\Model\Table\TransactionsTable $Transactions
 *
 * @method \App\Model\Entity\Transaction[] paginate($object = null, array $settings = [])
 */
class TransactionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'conditions' => [
                'Transactions.user_id' => $this->Auth->user('id'),
            ]
        ];
        $transactions = $this->paginate($this->Transactions);

        $loggedInUser = $this->Auth->user('id');

        $this->set(compact('transactions', 'loggedInUser'));
        $this->set('_serialize', ['transactions']);
    }

    /**
     * View method
     *
     * @param string|null $id Transaction id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $transaction = $this->Transactions->get($id, [
            'contain' => ['Users', 'Categories']
        ]);

        $loggedInUser = $this->Auth->user('id');

        if(!file_exists(__DIR__ . '/../../images/IMG_0492.JPG')){
            throw new NotFoundException("Warning: the provided file [".__DIR__ . '/../../images/IMG_0492.JPG'."] doesn't exist.");
        }

        // Create an instanceof tesseract with the filepath as first parameter
        $tesseractInstance = new TesseractOCR(__DIR__ . '/../../images/IMG_0492.JPG');
        
        // Execute tesseract to recognize text
        $result = $tesseractInstance->run();

        $this->set(compact('transaction', 'loggedInUser', 'result'));
        $this->set('_serialize', ['transaction']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $transaction = $this->Transactions->newEntity();
        if ($this->request->is('post')) {
            $transaction = $this->Transactions->patchEntity($transaction, $this->request->getData());
            $transaction->user_id = $this->Auth->user('id');
            if ($this->Transactions->save($transaction)) {
                $this->Flash->success(__('The transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The transaction could not be saved. Please, try again.'));
        }
        $loggedInUser = $this->Auth->user('id');
        $categories = $this->Transactions->Categories->find('list', ['limit' => 200]);
        $this->set(compact('transaction', 'categories', 'loggedInUser'));
        $this->set('_serialize', ['transaction']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Transaction id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $transaction = $this->Transactions->get($id, [
            'contain' => ['Categories']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $transaction = $this->Transactions->patchEntity($transaction, $this->request->getData());
            $transaction->user_id = $this->Auth->user('id');
            if ($this->Transactions->save($transaction)) {
                $this->Flash->success(__('The transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The transaction could not be saved. Please, try again.'));
        }
        $loggedInUser = $this->Auth->user('id');
        $categories = $this->Transactions->Categories->find('list', ['limit' => 200]);
        $this->set(compact('transaction', 'categories', 'loggedInUser'));
        $this->set('_serialize', ['transaction']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Transaction id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $transaction = $this->Transactions->get($id);
        if ($this->Transactions->delete($transaction)) {
            $this->Flash->success(__('The transaction has been deleted.'));
        } else {
            $this->Flash->error(__('The transaction could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function categories()
    {
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        $categories = $this->request->getParam('pass');

        $loggedInUser = $this->Auth->user('id');

        // Use the TransactionsTable to find categorized transactions.
        $transactions = $this->paginate($this->Transactions->find('categorized', [
            'categories' => $categories,
            'loggedInUser' => $loggedInUser
        ]));

        // Pass variables into the view template context.
        $this->set([
            'transactions' => $transactions,
            'categories' => $categories,
            'loggedInUser' => $loggedInUser
        ]);
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');

        // The add and index actions are always allowed.
        if (in_array($action, ['index', 'add', 'categories'])) {
            return true;
        }
        // All other actions require an id.
        if (!$this->request->getParam('pass.0')) {
            return false;
        }

        // Check that the transaction belongs to the current user.
        $id = $this->request->getParam('pass.0');
        $transaction = $this->Transactions->get($id);
        if ($transaction->user_id == $user['id']) {
            return true;
        }
        return parent::isAuthorized($user);
    }
}
