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
class ApiPackagesController extends AppController {

    public $Packages = null;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
        $this->viewBuilder()->setLayout('ajax');

        $this->Packages = TableRegistry::get('Packages');
        $this->PackageDurations = TableRegistry::get('PackageDurations');
        $this->PackageTypes = TableRegistry::get('PackageTypes');
        $this->UserPackages = TableRegistry::get('UserPackages');
        $this->UserPackageLines = TableRegistry::get('UserPackageLines');
        $this->PackageLines = TableRegistry::get('PackageLines');
        $this->UserPayments = TableRegistry::get('UserPayments');
        $this->Sizes = TableRegistry::get('Sizes');
    }

    public function listpackages() {
        $data = ['message' => '', 'status' => 400];

        if ($this->request->is(['get', 'ajax'])) {
            $getType = $this->request->getQuery('type');
            $getNewProject = $this->request->getQuery('newproject');
            $getSales = $this->request->getQuery('sales');
            $getRent = $this->request->getQuery('rest');
            $getPackage = $this->request->getQuery('package');

            $type = isset($getType)?(['PackageTypes.name' => $getType]):'';
            $newProject = ($getNewProject == 'Y')?(['Packages.name LIKE' => '%โครงการใหม่%']):'';
            $sales = ($getSales == 'Y')?(['Packages.name LIKE' => '%อสังหาขายด่วน%']):'';
            $rent = ($getRent == 'Y')?(['Packages.name LIKE' => '%อสังหามือสอง%']):'';
            $package = isset($getPackage)?(['Packages.id' => $getPackage]):'';

            $q = $this->Packages->find('all')
                ->contain(['Sizes','PackageTypes'])
                ->where([$package, $type, $newProject, $sales, $rent])
                ->order(['Packages.created' => 'ASC']);
            $packages = $q->toArray();

            if (sizeof($packages) > 0) {
                $data['status'] = 200;
                $data['packagelist'] = $packages;
            } else {
                $data['message'] = "Packages is empty.";
            }
        } else {
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data,JSON_PRETTY_PRINT);
        $this->set(compact('json'));
        $this->set('_serialize', 'json');
    }

    public function packages() {
        $data = ['message' => '', 'status' => 400];
        $id = $this->request->getQuery('id');
        if ($this->request->is(['get', 'ajax'])) {
              $packageid = isset($id) ? $id : '';
            
            if ($packageid != '') {
                $q = $this->Packages->find()
                        ->where(['id' => $packageid])
                        ->first();
                
                $data['status'] = 200;
                $data['detail'] = $q;
            } else {
                $data['message'] = "Package id is empty.";
            }
        } else {
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function packageBalance() {
        $data = ['message' => '', 'status' => 400];
        $id = $this->request->getQuery('uid');
        if ($this->request->is(['get', 'ajax'])) {
            $packages = $this->UserPackages->find()
                        ->contain(['UserPackageLines' => ['PackageLines' => ['Packages']]])
                        ->where(['UserPackages.user_id' => $id])
                        ->toArray();
            if(sizeof($packages) > 0) {
                $data['status'] = 200;
                $data['balance'] = $packages;
            }else{
                $data['message'] = 'no package balance.';
                $data['status'] = 404;
            }
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function packageBalanceLines() {
        $data = ['message' => '', 'status' => 400];
        $id = $this->request->getQuery('upid');
        if ($this->request->is(['get', 'ajax'])) {
            $balancelines = $this->UserPackageLines->find()
                        ->contain(['UserPayments'])
                        ->where(['UserPackageLines.user_package_id' => $id])
                        ->order(['UserPackageLines.created' => 'DESC'])
                        ->toArray();
            if(sizeof($balancelines) > 0) {
                $data['status'] = 200;
                $data['balance_line'] = $balancelines;
            }else{
                $data['message'] = 'no package balance lines.';
                $data['status'] = 404;
            }
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function packageDuration() {
        $data = ['message' => '', 'status' => 400];

        if ($this->request->is(['get', 'ajax'])) {
            $durations = $this->PackageDurations->find()->toArray();
            if(sizeof($durations) > 0) {
                $data['status'] = 200;
                $data['durations'] = $durations;
            }else{
                $data['message'] = 'error package duration.';
            }
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function packageSize() {
        $data = ['message' => '', 'status' => 400];

        if ($this->request->is(['get', 'ajax'])) {
            $sizes = $this->Sizes->find()->toArray();
            if(sizeof($sizes) > 0) {
                $data['status'] = 200;
                $data['sizes'] = $sizes;
            }else{
                $data['message'] = 'error package sizes.';
            }
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function packageList() {
        $data = ['message' => '', 'status' => 400];

        if ($this->request->is(['get', 'ajax'])) {
            $packages = $this->Packages->find()->order(['name' => 'ASC'])->toArray();
            if(sizeof($packages) > 0) {
                $data['status'] = 200;
                $data['packages'] = $packages;
            }
            else{
                $data['message'] = 'error package list.';
            }
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function packageAdList() {
        $data = ['message' => '', 'status' => 400];

        if ($this->request->is(['get', 'ajax'])) {
            $package_lines = $this->PackageLines->find()
                        ->contain(['PackageDurations', 'Packages', 'Sizes'])
                        ->where(['Packages.name' => 'ประกาศ (AD)'])
                        ->toArray();
            if(sizeof($package_lines) > 0) {
                $data['status'] = 200;
                $data['package_ad'] = $package_lines;
            }else{
                $data['message'] = 'error package ads.';
            }
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function packageBannerAList() {
        $data = ['message' => '', 'status' => 400];

        if ($this->request->is(['get', 'ajax'])) {
            $package_lines = $this->PackageLines->find()
                        ->contain(['PackageDurations', 'Packages'])
                        ->where(['Packages.name' => 'Banner A'])
                        ->order(['PackageDurations.duration_exp' => 'ASC'])
                        ->toArray();
            if(sizeof($package_lines) > 0) {
                $data['status'] = 200;
                $data['package_banner_a'] = $package_lines;
            }else{
                $data['message'] = 'error package banner A.';
            }
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function packageBannerBList() {
        $data = ['message' => '', 'status' => 400];

        if ($this->request->is(['get', 'ajax'])) {
            $package_lines = $this->PackageLines->find()
                        ->contain(['PackageDurations', 'Packages'])
                        ->where(['Packages.name' => 'Banner B'])
                        ->order(['PackageDurations.duration_exp' => 'ASC'])
                        ->toArray();
            if(sizeof($package_lines) > 0) {
                $data['status'] = 200;
                $data['package_banner_b'] = $package_lines;
            }else{
                $data['message'] = 'error package banner B.';
            }
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function saveUserTakePackage() {
        $data = ['message' => '', 'status' => 400];

        if($this->request->is(['post', 'ajax'])) {
            $postData = $this->request->getData();
            if(isset($postData)) {
                $Date = date('Y-m-d');
                $package = json_decode($postData['package']);
                $credit = $this->PackageLines->find()->contain(['Packages', 'PackageDurations'])->where(['PackageLines.id' => $package->{'ads_package'}])->first();
                $size = $this->Sizes->find()->where(['id' => $package->{'size'}])->first();
                if($package->{'ads_operate'} == 'buy'){
                    $user_package = $this->UserPackages->newEntity();
                    $user_package->user_id = $package->{'uid'};
                    $user_package->order_code = 'PKE_'.date('ymdhsi');
                    $user_package->duration = $package->{'ads_duration'};
                    $user_package->credit = ($credit->procredit != '') ? $credit->procredit : $credit->iscredit;
                    $user_package->used = 0;

                    if($this->UserPackages->save($user_package)) {
                        $package_line = $this->UserPackageLines->newEntity();
                        $package_line->user_package_id = $user_package->id;
                        $package_line->package_line_id = $package->{'ads_package'};
                        $package_line->package_name = $credit->package->name;
                        $package_line->size = $size->name;
                        $package_line->order_code = 'ADS_'.date('ymdhsi');
                        $package_line->price = $package->{'price'};
                        $package_line->credit = ($credit->procredit != '') ? $credit->procredit : $credit->iscredit;
                        $package_line->buy_date = $Date;
                        $package_line->duration_name = $credit->package_duration->duration_name;
                        $package_line->duration = $package->{'ads_duration'};

                        if($this->UserPackageLines->save($package_line)){
                            $payment = $this->UserPayments->newEntity();
                            $payment->user_package_line_id = $package_line->id;

                            if($this->UserPayments->save($payment)){
                                $data['status'] = 200;
                                $data['message'] = 'complete';
                            }else{
                                $data['message'] = 'error save user payment';
                            }
                        }else{
                            $data['message'] = 'error save user package line';
                        }
                    }else{
                        $data['message'] = 'error save user package';
                    }
                }else if($package->{'ads_operate'} == 'renew') {
                    $uPackages = $this->UserPackages->find()
                                ->where(['package_line_id' => $package->{'ads_package'}, 'isexpire' => 'Y'])
                                ->order(['created' => 'ASC'])
                                ->first();
                    if(sizeof($uPackages) > 0){
                        $package_line = $this->UserPackageLines->newEntity();
                        $package_line->user_package_id = $uPackages->id;
                        $package_line->order_code = 'ADS_'.date('ymdhsi');
                        $package_line->price = $package->{'price'};
                        $package_line->credit = 0;
                        $package_line->buy_date = $Date;
                        $package_line->duration = $package->{'ads_duration'};

                        if($this->UserPackageLines->save($package_line)){
                            $data['status'] = 200;
                            $data['message'] = 'complete';
                        }else{
                            $data['message'] = 'error save user package line';
                        }
                    }else{
                        $data['status'] = 404;
                        $data['message'] = 'no user package';
                    }
                }
            }else{
                $data['message'] = 'no data';
            }
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

}
