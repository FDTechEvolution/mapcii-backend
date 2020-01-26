<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * ApiAuthen Controller
 *
 *
 * @method \App\Model\Entity\ApiAuthen[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApiPaymentsController extends AppController {

    public $Payments = null;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
        $this->viewBuilder()->setLayout('ajax');

        $this->Payments = TableRegistry::get('Payments');
    }

    public function listpayment() {
        $data = ['message' => '', 'status' => 400];
        $id = $this->request->getQuery('id');
        if ($this->request->is(['get', 'ajax'])) {
            $userid = isset($id) ? $id : '';
            if ($userid != '') {
                $q = $this->Payments->find('all')
                        ->where(['user_id' => $userid]);
                $payment = $q->toArray();
                if (sizeof($payment) > 0) {
                    $data['status'] = 200;
                    $data['paymentlist'] = $payment;
                } else {
                    $data['message'] = "Payment list is empty.";
                }
            } else {
                $data['message'] = "User id is empty.";
            }
        } else {
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function payment() {
        $data = ['message' => '', 'status' => 400];
        $id = $this->request->getQuery('id');
        if ($this->request->is(['get', 'ajax'])) {
            $paymentid = isset($id) ? $id : '';

            if ($paymentid != '') {
                $q = $this->Payments->find()
                        ->where(['id' => $paymentid])
                        ->first();

                $data['status'] = 200;
                $data['detail'] = $q;
            } else {
                $data['message'] = "Payment id is empty.";
            }
        } else {
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function create() {
        $data = ['message' => '', 'status' => 400];
        $payment = $this->Payments->newEntity();
        if ($this->request->is(['post', 'ajax'])) {
            $postData = $this->request->getData();
            $amount = isset($postData['amount']) ? $postData['amount'] : '';
            if ($amount != '') {
                $payment = $this->Payments->patchEntity($payment, $postData);
                if ($this->Payments->save($payment)) {
                    $data['status'] = 200;
                    $data['message'] = "Created success.";
                } else {
                    $data['status'] = 400;
                    $data['message'] = "could not be created.";
                }
            } else {
                $data['message'] = "amount can't be empty.";
            }
        } else {
            $data['message'] = "incorrect method.";
        }
        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function void() {
        $data = ['message' => '', 'status' => 400];
        $id = $this->request->getQuery('id');
        if ($this->request->is(['post', 'ajax', 'delete'])) {
            $paymentid = isset($id) ? $id : '';

            if ($paymentid != '') {
                $q = $this->Payments->find()
                        ->where(['id' => $paymentid])
                        ->first();

                
                $q->status = 'VO';
                if ($this->Payments->save($q)) {
                    $data['status'] = 200;
                    $data['message'] = "Payment will be void.";
                } else {
                    $data['status'] = 400;
                    $data['message'] = "could not be void.";
                }
            } else {
                $data['message'] = "Payment id is empty.";
            }
        } else {
            $data['message'] = "incorrect method.";
        }
        $json = json_encode($data);
        $this->set(compact('json'));
    }

}
