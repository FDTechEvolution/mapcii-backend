<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FinancialAccounts Controller
 *
 * @property \App\Model\Table\FinancialAccountsTable $FinancialAccounts
 *
 * @method \App\Model\Entity\FinancialAccount[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FinancialAccountsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $financialAccounts = $this->paginate($this->FinancialAccounts);

        $this->set(compact('financialAccounts'));
    }

    /**
     * View method
     *
     * @param string|null $id Financial Account id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $financialAccount = $this->FinancialAccounts->get($id, [
            'contain' => ['Payments']
        ]);

        $this->set('financialAccount', $financialAccount);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $financialAccount = $this->FinancialAccounts->newEntity();
        if ($this->request->is('post')) {
            $financialAccount = $this->FinancialAccounts->patchEntity($financialAccount, $this->request->getData());
            if ($this->FinancialAccounts->save($financialAccount)) {
                $this->Flash->success(__('The financial account has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The financial account could not be saved. Please, try again.'));
        }
        $this->set(compact('financialAccount'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Financial Account id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $financialAccount = $this->FinancialAccounts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $financialAccount = $this->FinancialAccounts->patchEntity($financialAccount, $this->request->getData());
            if ($this->FinancialAccounts->save($financialAccount)) {
                $this->Flash->success(__('The financial account has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The financial account could not be saved. Please, try again.'));
        }
        $this->set(compact('financialAccount'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Financial Account id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $financialAccount = $this->FinancialAccounts->get($id);
        if ($this->FinancialAccounts->delete($financialAccount)) {
            $this->Flash->success(__('The financial account has been deleted.'));
        } else {
            $this->Flash->error(__('The financial account could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
