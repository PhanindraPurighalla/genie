<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TransactionsDocuments Controller
 *
 * @property \App\Model\Table\TransactionsDocumentsTable $TransactionsDocuments
 *
 * @method \App\Model\Entity\TransactionsDocument[] paginate($object = null, array $settings = [])
 */
class TransactionsDocumentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Transactions', 'Documents']
        ];
        $transactionsDocuments = $this->paginate($this->TransactionsDocuments);

        $this->set(compact('transactionsDocuments'));
        $this->set('_serialize', ['transactionsDocuments']);
    }

    /**
     * View method
     *
     * @param string|null $id Transactions Document id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $transactionsDocument = $this->TransactionsDocuments->get($id, [
            'contain' => ['Transactions', 'Documents']
        ]);

        $this->set('transactionsDocument', $transactionsDocument);
        $this->set('_serialize', ['transactionsDocument']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $transactionsDocument = $this->TransactionsDocuments->newEntity();
        if ($this->request->is('post')) {
            $transactionsDocument = $this->TransactionsDocuments->patchEntity($transactionsDocument, $this->request->getData());
            if ($this->TransactionsDocuments->save($transactionsDocument)) {
                $this->Flash->success(__('The transactions document has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The transactions document could not be saved. Please, try again.'));
        }
        $transactions = $this->TransactionsDocuments->Transactions->find('list', ['limit' => 200]);
        $documents = $this->TransactionsDocuments->Documents->find('list', ['limit' => 200]);
        $this->set(compact('transactionsDocument', 'transactions', 'documents'));
        $this->set('_serialize', ['transactionsDocument']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Transactions Document id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $transactionsDocument = $this->TransactionsDocuments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $transactionsDocument = $this->TransactionsDocuments->patchEntity($transactionsDocument, $this->request->getData());
            if ($this->TransactionsDocuments->save($transactionsDocument)) {
                $this->Flash->success(__('The transactions document has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The transactions document could not be saved. Please, try again.'));
        }
        $transactions = $this->TransactionsDocuments->Transactions->find('list', ['limit' => 200]);
        $documents = $this->TransactionsDocuments->Documents->find('list', ['limit' => 200]);
        $this->set(compact('transactionsDocument', 'transactions', 'documents'));
        $this->set('_serialize', ['transactionsDocument']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Transactions Document id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $transactionsDocument = $this->TransactionsDocuments->get($id);
        if ($this->TransactionsDocuments->delete($transactionsDocument)) {
            $this->Flash->success(__('The transactions document has been deleted.'));
        } else {
            $this->Flash->error(__('The transactions document could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
