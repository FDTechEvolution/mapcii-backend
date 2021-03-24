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
        $this->AssetAds = TableRegistry::get('AssetAds');
        $this->UserPayments = TableRegistry::get('UserPayments');
    }

    public function listpayment() {
        $data = ['message' => '', 'status' => 400];
        $id = $this->request->getQuery('id');
        if ($this->request->is(['get', 'ajax'])) {
            $userid = isset($id) ? $id : '';
            if ($userid != '') {
                // $this->log($userid, 'debug');
                $q = $this->Payments->find()
                        ->contain(['Packages' => ['Sizes','Positions','PackageTypes']])
                        ->where(['user_id' => $userid]);
                $payment = $q->toArray();
                if (is_array($payment)) {
                    $newPayment = [];
                    foreach($payment as $index=>$item){
                        $ads = $this->AssetAds->find()
                                ->contain(['Assets'])
                                ->where(['payment_id' => $item->id])->first();
                        if($ads){
                            $item['ads'] = $ads;
                            array_push($newPayment, $item);
                            // $this->log($ads, 'debug');
                            // $newPayment = $item;
                        }else{
                            array_push($newPayment, $item);
                        }
                        $data['paymentlist'] = $newPayment;
                    }
                    $data['status'] = 200;
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
                if (is_array($paymentline)) {
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
                $this->Packages = TableRegistry::get('packages');
                $package = $this->Packages->find('all')->where(['id' => $postData['package_id']])->first();
                $this->log($package->position_id, 'debug');

                $this->PaymentLines = TableRegistry::get('payment_lines');
                $payment_line = $this->PaymentLines->newEntity();
                $payment_line = $this->PaymentLines->patchEntity($payment_line, $postData);
                $payment_line->documentno = "mc-ads_". date('Yms');
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
                    $data['payment'] = $payment->id;
                    $data['position'] = $package->position_id;
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

    public function paymentExp() {
        if ($this->request->is(['get', 'ajax'])) {
            $date_now = date_create(date('Y-m-d'));
            // $date2=date_create("2013-12-12");
            // $diff = date_diff($date_now,$date2);
            // if($diff->format("%R%a") <= 0) {
            //     $this->log('check pass', 'debug');
            // }else{
            //     $this->log('check fail', 'debug');
            // }
            // $this->log($diff->format("%R%a"), 'debug');
            // $this->log($date_now, 'debug');
            $payments = $this->Payments->find('all')->where(['status' => 'CO'])->toArray();
            if(is_array($payments)) {
                foreach($payments as $payment) {
                    if($date_now >= $payment->duration) {
                        $payment->status = 'EX';
                        $this->Payments->save($payment);
                    }
                }
                $data['message'] = "OK";
            }
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

    public function userPackagePayment() {
        $data = ['message' => '', 'status' => 400];
        if ($this->request->is(['post', 'ajax'])) {
            $postData = $this->request->getData();
            $payment = $this->UserPayments->find()->where(['user_package_line_id' => $postData['id']])->first();
            $payment->documentno = 'PAY_'.date('ymdhsi');
            $payment->payment_method = 'BANK';
            $payment->payment_date = date('Y-m-d');
            if($postData['image_id']['tmp_name'] !=''){
                $this->loadComponent('UploadImage');
                $imageId = $this->UploadImage->uploadSlip($postData['image_id']);
                $payment->image_id = $imageId['image_id'];
            }
            $payment->status = 'CK';

            if($this->UserPayments->save($payment)) {
                $data['status'] = 200;
                $data['message'] = 'complete.';
            }
        } else {
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

}
