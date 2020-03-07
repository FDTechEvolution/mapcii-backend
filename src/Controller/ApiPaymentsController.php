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
        $this->PaymentLines = TableRegistry::get('payment_lines');
    }

    public function listpayment() {
        $data = ['message' => '', 'status' => 400];
        $id = $this->request->getQuery('id');
        if ($this->request->is(['get', 'ajax'])) {
            $userid = isset($id) ? $id : '';
            if ($userid != '') {
                $q = $this->Payments->find('all')
                        ->contain(['Packages' => ['Sizes','Positions']])
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

    public function listpaymentline() {
        $data = ['message' => '', 'status' => 400];
        $id = $this->request->getQuery('id');
        if ($this->request->is(['get', 'ajax'])) {
            $payid = isset($id) ? $id : '';
            if($payid != ''){
                $query = $this->PaymentLines->find('all')
                            ->contain(['FinancialAccounts', 'Images'])
                            ->where(['payment_id' => $payid])
                            ->order(['payment_lines.created' => 'DESC']);
                $paymentline = $query->toArray();
                if (sizeof($paymentline) > 0) {
                    $data['status'] = 200;
                    $data['paymentline'] = $paymentline;
                } else {
                    $data['message'] = "Payment line is empty.";
                }
            } else {
                $data['message'] = "Pay id is empty.";
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

            $payment = $this->Payments->patchEntity($payment, $postData);
            $payment->package_amount = $postData['amount'];
            if ($this->Payments->save($payment)) {
                $this->PaymentLines = TableRegistry::get('payment_lines');
                $payment_line = $this->PaymentLines->newEntity();
                $payment_line = $this->PaymentLines->patchEntity($payment_line, $postData);
                $payment_line->documentno = "mc-ads_". date('Ymsu');
                $payment_line->payment_id = $payment->id;
                $payment_line->payment_date = date('Y-m-d');
                $payment_line->status = 'DR';

                if($postData['image_id']['tmp_name'] !=''){
                    $this->loadComponent('UploadImage');
                    $imageId = $this->UploadImage->uploadSlip($postData['image_id']);
                    $payment_line->image_id = $imageId['image_id'];
                }

                if($this->PaymentLines->save($payment_line)){
                    $data['status'] = 200;
                    $data['message'] = "Created success.";
                } else {
                    $data['status'] = 400;
                    $data['message'] = "Payment Line could not be created.";
                }
            } else {
                $data['status'] = 400;
                $data['message'] = "Payment could not be created.";
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

    public function exp() {
        $data = ['message' => '', 'status' => 400];
        $id = $this->request->getQuery('id');
        if ($this->request->is(['post', 'ajax', 'delete'])) {
            $paymentid = isset($id) ? $id : '';

            if ($paymentid != '') {
                $q = $this->Payments->find()
                        ->where(['id' => $paymentid])
                        ->first();
                
                $q->status = 'EX';
                if ($this->Payments->save($q)) {
                    $data['status'] = 200;
                    $data['message'] = "Payment will be exp.";
                } else {
                    $data['status'] = 400;
                    $data['message'] = "could not be exp.";
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

    public function renew($id) {
        $data = ['message' => '', 'status' => 400];
        $payment_line = $this->PaymentLines->newEntity();
        if ($this->request->is(['post', 'ajax'])) {
            $postData = $this->request->getData();

            $payment_line = $this->PaymentLines->patchEntity($payment_line, $postData);
            $payment_line->documentno = "mc-ads_". date('Ymsu');
            $payment_line->payment_id = $id;
            $payment_line->payment_date = date('Y-m-d');
            $payment_line->status = 'DR';

            if($postData['image_id']['tmp_name'] !=''){
                $this->loadComponent('UploadImage');
                $imageId = $this->UploadImage->uploadSlip($postData['image_id']);
                $payment_line->image_id = $imageId['image_id'];
            }

            if($this->PaymentLines->save($payment_line)){
                $payment = $this->Payments->find()
                            ->where(['id' => $id])
                            ->first();
                $payment->status = 'DR';
                $payment->duration = '';
                $payment->package_name = $postData['package_name'];
                $payment->package_amount = $postData['amount'];
                $payment->package_duration = $postData['package_duration'];

                if($this->Payments->save($payment)){
                    $data['status'] = 200;
                    $data['message'] = "Renew success.";
                } else {
                    $data['status'] = 400;
                    $data['message'] = "Payment could not be created.";
                }
                
            } else {
                $data['status'] = 400;
                $data['message'] = "Payment Line could not be created.";
            }

        } else {
            $data['message'] = "incorrect method.";
        }
        $json = json_encode($data);
        $this->set(compact('json'));
    }

}
