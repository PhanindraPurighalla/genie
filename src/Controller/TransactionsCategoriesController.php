<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TransactionsCategories Controller
 *
 * @property \App\Model\Table\TransactionsCategoriesTable $TransactionsCategories
 *
 * @method \App\Model\Entity\TransactionsCategory[] paginate($object = null, array $settings = [])
 */
class TransactionsCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Transactions', 'Categories']
        ];
        $transactionsCategories = $this->paginate($this->TransactionsCategories);

        $this->set(compact('transactionsCategories'));
        $this->set('_serialize', ['transactionsCategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Transactions Category id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $transactionsCategory = $this->TransactionsCategories->get($id, [
            'contain' => ['Transactions', 'Categories']
        ]);

        $this->set('transactionsCategory', $transactionsCategory);
        $this->set('_serialize', ['transactionsCategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $transactionsCategory = $this->TransactionsCategories->newEntity();
        if ($this->request->is('post')) {
            $transactionsCategory = $this->TransactionsCategories->patchEntity($transactionsCategory, $this->request->getData());
            if ($this->TransactionsCategories->save($transactionsCategory)) {
                $this->Flash->success(__('The transactions category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The transactions category could not be saved. Please, try again.'));
        }
        $transactions = $this->TransactionsCategories->Transactions->find('list', ['limit' => 200]);
        $categories = $this->TransactionsCategories->Categories->find('list', ['limit' => 200]);
        $this->set(compact('transactionsCategory', 'transactions', 'categories'));
        $this->set('_serialize', ['transactionsCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Transactions Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $transactionsCategory = $this->TransactionsCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $transactionsCategory = $this->TransactionsCategories->patchEntity($transactionsCategory, $this->request->getData());
            if ($this->TransactionsCategories->save($transactionsCategory)) {
                $this->Flash->success(__('The transactions category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The transactions category could not be saved. Please, try again.'));
        }
        $transactions = $this->TransactionsCategories->Transactions->find('list', ['limit' => 200]);
        $categories = $this->TransactionsCategories->Categories->find('list', ['limit' => 200]);
        $this->set(compact('transactionsCategory', 'transactions', 'categories'));
        $this->set('_serialize', ['transactionsCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Transactions Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $transactionsCategory = $this->TransactionsCategories->get($id);
        if ($this->TransactionsCategories->delete($transactionsCategory)) {
            $this->Flash->success(__('The transactions category has been deleted.'));
        } else {
            $this->Flash->error(__('The transactions category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
