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
    private $Complete = 'CO';
    private $Expire = 'EX';
    private $Draft = 'DR';
    private $Delete = 'DL';
    private $Y = 'Y';
    private $N = 'N';

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
        $this->Assets = TableRegistry::get('Assets');
        $this->AssetAds = TableRegistry::get('AssetAds');
        $this->Banners = TableRegistry::get('Banners');
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

            if (is_array($packages)) {
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
                        ->where(['UserPackages.user_id' => $id, 'UserPackages.status !=' => $this->Delete])
                        ->toArray();
            if(is_array($packages)) {
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
            if(is_array($balancelines)) {
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
            if(is_array($durations)) {
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
            if(is_array($sizes)) {
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
            if(is_array($packages)) {
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
            if(is_array($package_lines)) {
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
            if(is_array($package_lines)) {
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
            if(is_array($package_lines)) {
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
                $size = (isset($package->{'size'})) ? $this->Sizes->find()->where(['id' => $package->{'size'}])->first() : '';
                $this->log($size, 'debug');
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
                        $package_line->size = ($size != '') ? $size->name : null;
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
                    if(isset($uPackages)){
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

    public function saveUserRenewPackage() {
        $data = ['message' => '', 'status' => 400];
        $Date = date('Y-m-d');

        if($this->request->is('post','ajax')) {
            $postData = $this->request->getData();
            $user_package = $this->UserPackages->get($postData['user_package_id']);
            $duration = $this->PackageDurations->get($postData['duration_id']);
            $package_line = $this->PackageLines->find()->contain(['Packages'])->where(['PackageLines.id' => $postData['package_line_id']])->first();
            $size = ($postData['size_id'] != '') ? $this->Sizes->get($postData['size_id']) : NULL;

            $user_package_line = $this->UserPackageLines->newEntity();
            $user_package_line->user_package_id = $postData['user_package_id'];
            $user_package_line->package_line_id = $postData['package_line_id'];
            $user_package_line->package_name = $package_line->package->name;
            $user_package_line->size = ($size != NULL) ? $size->name : NULL;
            $user_package_line->order_code = 'ADS_'.date('ymdhsi');
            $user_package_line->price = ($package_line->proprice != '') ? $package_line->proprice : $package_line->isprice;
            $user_package_line->credit = ($package_line->proprice != '') ? $package_line->procredit : $package_line->iscredit;
            $user_package_line->buy_date = $Date;
            $user_package_line->duration_name = $duration->duration_name;
            $user_package_line->duration = $duration->duration_exp;

            if($this->UserPackageLines->save($user_package_line)) {
                $payment = $this->UserPayments->newEntity();
                $payment->user_package_line_id = $user_package_line->id;

                if($this->UserPayments->save($payment)){
                    $data['status'] = 200;
                    $data['message'] = 'complete';
                }else{
                    $data['message'] = 'error save user payment';
                }
            }else{
                $data['message'] = 'failed.';
            }
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function closePackageBalance() {
        $data = ['message' => '', 'status' => 400];
        if($this->request->is('get', 'ajax')) {
            $id = $this->request->getQuery('id');
            $user_package = $this->UserPackages->get($id);
            $user_package->status = $this->Delete;

            if($this->UserPackages->save($user_package)) {
                $data['status'] = 200;
            }
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function checkPackageLineDueDate() {
        if($this->request->is('get', 'ajax')) {
            $date_now = date_create(date('Y-m-d'));
            $user_package_line = $this->UserPackageLines->find('all')->where(['isexpire' => 'N'])->toArray();
            if(is_array($user_package_line)) {
                foreach ($user_package_line as $u_pack_ln) {
                    $startdate = date_create(date_format($u_pack_ln->start_date, "Y-m-d"));
                    $date_plus = date_add($startdate,date_interval_create_from_date_string($u_pack_ln->duration." days"));
                    $duedate = date_create(date_format($date_plus,"Y-m-d"));
                    $diff = date_diff($date_now, $duedate);
                    $set_diff = $diff->format("%R%a");
                    if($set_diff < 0) {
                        $u_pack_ln->isexpire = 'Y';
                        $this->UserPackageLines->save($u_pack_ln);
                        $this->checkPackageDueDate($u_pack_ln->user_package_id, $u_pack_ln->package_name);
                    }
                }
            }
        }
    }

    private function checkPackageDueDate($u_pack_id, $package_name) {
        $user_package = $this->UserPackages->find()->where(['id' => $u_pack_id])->first();
        if($user_package->isexpire == 'N') {
            $user_package->isexpire = 'Y';
            $user_package->status = 'EX';
            if($this->UserPackages->save($user_package)) {
                if($package_name == 'ประกาศ (AD)') $this->checkAssetDuedate($user_package->id);
                if($package_name == 'Banner A' || $package_name == 'Banner B') $this->checkBannerDuedate($user_package->id);
            }
        }
    }

    private function checkAssetDuedate($user_package_id) {
        $asset_ads = $this->AssetAds->find()->where(['user_package_id' => $user_package_id])->toArray();
        foreach($asset_ads as $ads){
            $assets = $this->Assets->get($ads->asset_id);
            $assets->status = 'EX';
            $this->Assets->save($assets);
        }
    }

    private function checkBannerDuedate($user_package_id) {
        $banner = $this->Banners->find()->where(['user_package_id' => $user_package_id])->first();
        if(isset($banner)) {
            $banner->status = 'EX';
            $this->Banners->save($banner);
        }
    }

}
