<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Assets Controller
 *
 * @property \App\Model\Table\AssetsTable $Assets
 *
 * @method \App\Model\Entity\Asset[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssetsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {

        $q = $this->Assets->find()
                ->contain(['AssetTypes' => 'AssetCategories', 'Users', 'Addresses'])
                ->where(['Assets.status' => 'CO'])
                ->order(['Assets.created' => 'ASC']);
        $assets = $q->toArray();
        //  $this->log($assets, 'debug');
        $this->set(compact('assets'));
    }

    public function ads() {
        $this->AssetAds = TableRegistry::get('AssetAds');
        // $this->PaymentLines = TableRegistry::get('PaymentLines');
        $this->UserPackages = TableRegistry::get('UserPackages');
        $this->AssetImages = TableRegistry::get('AssetImages');
        $this->UserPackageLines = TableRegistry::get('UserPackageLines');
        $this->Banners = TableRegistry::get('Banners');
        $q = $this->AssetAds->find();
                $q->select([
                    'id' => 'Assets.id', 
                    'code' => 'Assets.code', 
                    'topic' => 'Assets.name',
                    'startdate' => 'Assets.startdate', 
                    'name' => 'Users.firstname', 
                    'lname' => 'Users.lastname',
                    'type' => 'AssetTypes.name',
                    'user_package_id' => 'UserPackages.id',
                    'order_code' => 'UserPackages.order_code',
                    'price' => 'Assets.price',
                    'discount' => 'Assets.discount',
                    'rental' => 'Assets.rental'
                ])
                ->contain(['Assets' => ['AssetTypes', 'Users', 'AssetImages' => ['Images']], 'UserPackages' => ['UserPackageLines' => ['UserPayments']]])
                ->where(['Assets.status !=' => 'DL'])
                ->order(['AssetAds.created' => 'DESC']);
        $ads = $q->toArray();
        // $this->log($ads, 'debug');
        $userpackage = [];
        $assetImage = [];
        foreach($ads as $ad) {
            $query = $this->UserPackageLines->find()
                        ->where(['user_package_id' => $ad->user_package_id])
                        ->last();
            array_push($userpackage, $query);

            $img = $this->AssetImages->find()
                        ->contain(['Images'])
                        ->where(['AssetImages.asset_id' => $ad->id, 'AssetImages.isdefault' => 'Y'])
                        ->first();
            array_push($assetImage, $img);
        }
        $this->set(compact('ads', 'userpackage', 'assetImage'));

        //Banner Query
        $b = $this->Banners->find();
            $b->select([
                'id' => 'Banners.id',
                'topic' => 'Banners.topic',
                'startdate' => 'Banners.created',
                'name' => 'Users.firstname',
                'type' => 'Banners.type',
                'user_package_id' => 'UserPackages.id',
                'order_code' => 'UserPackages.order_code',
                'image' => 'Images.url'
            ])
            ->contain(['Users', 'Images', 'UserPackages' => ['UserPackageLines']])
            ->where(['Banners.status !=' => 'DL'])
            ->order(['Banners.created' => 'DESC']);
        $banners = $b->toArray();
        $user_banner_package = [];
        foreach($banners as $banner) {
            $query = $this->UserPackageLines->find()
                        ->where(['user_package_id' => $banner->user_package_id])
                        ->last();
            array_push($user_banner_package, $query);
        }
        $this->set(compact('banners', 'user_banner_package'));
    }

    public function freeAssets() {
        $this->AssetAds = TableRegistry::get('AssetAds');
        $this->AssetImages = TableRegistry::get('AssetImages');
        $assets = $this->Assets->find()
                ->contain(['AssetTypes', 'Users', 'AssetImages' => ['Images']])
                ->where(['Assets.status !=' => 'DL'])
                ->order(['Assets.created' => 'DESC'])
                ->toArray();

        $assetFreeImage = [];
        $assetFree = [];
        foreach($assets as $asset) {
            $ads = $this->AssetAds->find()->where(['asset_id' => $asset->id])->first();
            if(is_array($ads) == 0) {
                array_push($assetFree, $asset);
            }
            $img = $this->AssetImages->find()
                        ->contain(['Images'])
                        ->where(['AssetImages.asset_id' => $asset->id, 'AssetImages.isdefault' => 'Y'])
                        ->first();
            array_push($assetFreeImage, $img);
        }

        $this->set(compact('assetFree', 'assetFreeImage'));
    }

    public function unAssetAds() {
        $this->Assets = TableRegistry::get('Assets');
        $this->UserPackages = TableRegistry::get('UserPackages');
        if ($this->request->is('post')) {
            $postData = $this->request->getData();
            $asset = $this->Assets->get($postData['ads_id'], [
                'contain' => ['AssetAds' => ['UserPackages']]
            ]);
            $asset->status = 'DL';
            $asset->reason_del = $postData['reason_del'];
            if($this->Assets->save($asset)){
                $user_package = $this->UserPackages->get($asset->asset_ads[0]->user_package->id);
                $is_used = $user_package->used - 1;
                $user_package->used = $is_used;
                if($this->UserPackages->save($user_package)){
                    $this->Flash->success(__('ข้อมูลถูกยกเลิก และ ย้ายไปยังประวัติการจัดการเรียบร้อยแล้ว'));
                    return $this->redirect(['action' => 'ads']);
                }
            }
            $this->Flash->error(__('ไม่สามารถยกเลิกได้ในตอนนี้ กรุณาลองใหม่'));
        }
    }

    public function unAssetFree() {
        $this->Assets = TableRegistry::get('Assets');
        if ($this->request->is('post')) {
            $postData = $this->request->getData();
            $asset = $this->Assets->get($postData['asset_id']);
            $asset->status = 'DL';
            $asset->reason_del = $postData['reason_del'];
            if($this->Assets->save($asset)){
                $this->Flash->success(__('ข้อมูลถูกยกเลิก และ ย้ายไปยังประวัติการจัดการเรียบร้อยแล้ว'));
                return $this->redirect(['action' => 'free-assets']);
            }
            $this->Flash->error(__('ไม่สามารถยกเลิกได้ในตอนนี้ กรุณาลองใหม่'));
        }
    }

    public function unBannerAds() {
        $this->Banners = TableRegistry::get('Banners');
        $this->UserPackages = TableRegistry::get('UserPackages');
        if ($this->request->is('post')) {
            $postData = $this->request->getData();
            $banner = $this->Banners->get($postData['banner_id']);
            $banner->status = 'CO';
            $banner->reason_del = $postData['reason_del'];
            if($this->Banners->save($banner)){
                $user_package = $this->UserPackages->get($banner->user_package_id);
                $is_used = $user_package->used - 1;
                $user_package->used = $is_used;
                if($this->UserPackages->save($user_package)){
                    $this->Flash->success(__('ข้อมูลถูกยกเลิก และ ย้ายไปยังประวัติการจัดการเรียบร้อยแล้ว'));
                    return $this->redirect(['action' => 'ads']);
                }
            }
            $this->Flash->error(__('ไม่สามารถยกเลิกได้ในตอนนี้ กรุณาลองใหม่'));
        }
    }

    public function adsapprove ($id = null) {
        $this->PaymentLines = TableRegistry::get('payment_lines');
        $this->Payments = TableRegistry::get('payments');
        $payment_line = $this->PaymentLines->get($id);
        $date = date('Y-m-d');
        $payment_line->status = 'CO';
        if ($this->PaymentLines->save($payment_line)) {
            $payment = $this->Payments->get($payment_line->payment_id);
            $payment->status = 'CO';
            $payment->duration = date('Y-m-d', strtotime($date. ($payment->package_duration == '1 เดือน' ? ' + 30 days' : ($payment->package_duration == '1 ปี' ? ' + 1 years' : ''))));
            if($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been paid.'));
                return $this->redirect(['action' => 'ads']);
            } else {
                $this->Flash->error(__('The payment could not be paid. Please, try again.'));
            }
        }
        $this->Flash->error(__('The payment line could not be paid. Please, try again.'));

        $this->set(compact('payment'));
    }
    
    public function approveRequest(){
        $q = $this->Assets->find()
                ->contain(['AssetTypes' => 'AssetCategories', 'Users', 'Addresses'])
                ->where(['Assets.status'=>'WT'])
                ->order(['Assets.created' => 'ASC']);
        $assets = $q->toArray();
        //  $this->log($assets, 'debug');
        $this->set(compact('assets'));
    }

    public function assetExp() {
        $q = $this->Assets->find()
                ->contain(['AssetTypes' => 'AssetCategories', 'Users', 'Addresses'])
                ->where(['Assets.status' => 'EX'])
                ->order(['Assets.created' => 'ASC']);
        $assets = $q->toArray();
        //  $this->log($assets, 'debug');
        $this->set(compact('assets'));
    }

    public function blockUser () {
        $this->Users = TableRegistry::get('users');

        if ($this->request->is('post')) {
            $postData = $this->request->getData();

            $user = $this->Users->get($postData['user_id']);
            $user->islocked = 'Y';
            $user->locktime = $postData['block_time'];
            
            if($this->Users->save($user)){
                return $this->redirect(['action'=>'index']);
            }
        }
    }

    public function unblockUser ($id = null) {
        $this->Users = TableRegistry::get('users');

        $user = $this->Users->get($id);
        $user->islocked = 'N';
        $this->Users->save($user);

        return $this->redirect(['action'=>'index']);
    }
    
    public function approve($asset_id = null){
        $asset = $this->Assets->get($asset_id);
        $asset->status = 'CO';
        $asset->isactive = 'Y';
        $this->Assets->save($asset);
        
        return $this->redirect(['action'=>'approve-request']);
    }

    /**
     * View method
     *
     * @param string|null $id Asset id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $asset = $this->Assets->get($id, [
            'contain' => ['AssetTypes', 'Users', 'Addresses', 'AssetImages', 'AssetOptions']
        ]);

        $this->set('asset', $asset);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $asset = $this->Assets->newEntity();
        if ($this->request->is('post')) {
            $asset = $this->Assets->patchEntity($asset, $this->request->getData());
            if ($this->Assets->save($asset)) {
                $this->Flash->success(__('The asset has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The asset could not be saved. Please, try again.'));
        }
        $assetTypes = $this->Assets->AssetTypes->find('list', ['limit' => 200]);
        $users = $this->Assets->Users->find('list', ['limit' => 200]);
        $addresses = $this->Assets->Addresses->find('list', ['limit' => 200]);
        $this->set(compact('asset', 'assetTypes', 'users', 'addresses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Asset id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $asset = $this->Assets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $asset = $this->Assets->patchEntity($asset, $this->request->getData());
            if ($this->Assets->save($asset)) {
                $this->Flash->success(__('The asset has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The asset could not be saved. Please, try again.'));
        }
        $assetTypes = $this->Assets->AssetTypes->find('list', ['limit' => 200]);
        $users = $this->Assets->Users->find('list', ['limit' => 200]);
        $addresses = $this->Assets->Addresses->find('list', ['limit' => 200]);
        $this->set(compact('asset', 'assetTypes', 'users', 'addresses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Asset id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $asset = $this->Assets->get($id);
        if ($this->Assets->delete($asset)) {
            $this->Flash->success(__('The asset has been deleted.'));
        } else {
            $this->Flash->error(__('The asset could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function saveactive() {


        $this->autoRender = false;

        $id = $this->request->getQuery('id');

        $asset = $this->Assets->get($id);

        if ($asset->isactive == 'Y') {
            $asset->isactive = "N";
        } else {
            $asset->isactive = "Y";
        }
        if ($this->Assets->save($asset)) {
            echo json_encode('Success');
            $this->Flash->success(__('Success.'));
        }else{
            $this->Flash->error(__('Error.'));
            echo json_encode('Error');
        }
        
    }

}
