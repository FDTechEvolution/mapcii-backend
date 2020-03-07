<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Payments Controller
 *
 * @property \App\Model\Table\PaymentsTable $Payments
 *
 * @method \App\Model\Entity\Payment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaymentsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {

        $docStatusList = $this->Core->getStatusCode();
        $docStatusPayment = $this->Core->getStatusCodePayment();
        $notificationPayment = $this->loadComponent('Notification');

        $q = $this->Payments->find()
                ->contain(['Users', 'Packages'])
                ->order(['Payments.modified' => 'DESC']);
        $payments = $q->toArray();
        $this->set(compact('payments', 'docStatusPayment', 'notificationPayment'));

        $this->PaymentLines = TableRegistry::get('payment_lines');
        $query = $this->PaymentLines->find()
                    ->contain(['Payments' => ['Users'], 'FinancialAccounts', 'Images'])
                    ->order(['payment_lines.created' => 'DESC']);
        $paymentlines = $query->toArray();
        $this->set(compact('paymentlines', 'docStatusList'));
    }

    /**
     * View method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $payment = $this->Payments->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('payment', $payment);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $payment = $this->Payments->newEntity();
        if ($this->request->is('post')) {
            $payment = $this->Payments->patchEntity($payment, $this->request->getData());
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        $users = $this->Payments->Users->find('list', ['limit' => 200]);
        $financialAccounts = $this->Payments->FinancialAccounts->find('list', ['limit' => 200]);
        $this->set(compact('payment', 'users', 'financialAccounts'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $payment = $this->Payments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $payment = $this->Payments->patchEntity($payment, $this->request->getData());
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        $users = $this->Payments->Users->find('list', ['limit' => 200]);
        $financialAccounts = $this->Payments->FinancialAccounts->find('list', ['limit' => 200]);
        $this->set(compact('payment', 'users', 'financialAccounts'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $payment = $this->Payments->get($id);
        $payment->status = 'VO';
        if ($this->Payments->save($payment)) {
            $this->Flash->success(__('The payment has been void.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The payment could not be void. Please, try again.'));
    }

    public function approve($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $this->PaymentLines = TableRegistry::get('payment_lines');
        $payment_line = $this->PaymentLines->get($id);
        $date = date('Y-m-d');
        $payment_line->status = 'CO';
        if ($this->PaymentLines->save($payment_line)) {
            $payment = $this->Payments->get($payment_line->payment_id);
            $payment->status = 'CO';
            $payment->duration = date('Y-m-d', strtotime($date. ($payment->package_duration == '1 เดือน' ? ' + 30 days' : ($payment->package_duration == '1 ปี' ? ' + 1 years' : ''))));
            if($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been paid.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The payment could not be paid. Please, try again.'));
            }
            
        }
        $this->Flash->error(__('The payment line could not be paid. Please, try again.'));

        $this->set(compact('payment'));
    }

}
