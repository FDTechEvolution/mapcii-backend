<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * ApiBanners Controller
 *
 *
 * @method \App\Model\Entity\ApiBanner[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApiBannersController extends AppController
{
    public $Banners = null;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
        $this->viewBuilder()->setLayout('ajax');

        $this->Banners = TableRegistry::get('Banners');
        $this->Packages = TableRegistry::get('Packages');
        $this->BannerLines = TableRegistry::get('banner_lines');
        $this->UserPackages = TableRegistry::get('user_packages');
    }

    public function listbanner () {
        $data = ['message' => '', 'status' => 400];
        $id = $this->request->getQuery('id');
        if ($this->request->is(['get', 'ajax'])) {
            $payment_id = isset($id) ? $id : '';
            if ($payment_id != '') {
                $q = $this->Banners->find('all')
                        ->where(['payment_id' => $payment_id]);
                $banner = $q->toArray();
                if (sizeof($banner) > 0) {
                    $data['status'] = 200;
                    $data['bannerlist'] = $banner;
                } else {
                    $data['status'] = 100;
                    $data['message'] = "Banner list is empty.";
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

    public function listbannerline () {
        $data = ['message' => '', 'status' => 400];
        $id = $this->request->getQuery('id');
        if ($this->request->is(['get', 'ajax'])) {
            $payment_id = isset($id) ? $id : '';
            if ($payment_id != '') {
                $q = $this->BannerLines->find('all')
                        ->contain(['Banners' => ['Positions'], 'Images'])
                        ->where(['Banners.payment_id' => $payment_id]);
                $banner_line = $q->toArray();
                if (sizeof($banner_line) > 0) {
                    $data['status'] = 200;
                    $data['bannerlinelist'] = $banner_line;
                } else {
                    $data['status'] = 100;
                    $data['message'] = "Banner Line list is empty.";
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

    public function loadbannerimages () {
        $data = ['message' => '', 'status' => 400];
        $getPosition = $this->request->getQuery('position');
        $getLimit = $this->request->getQuery('limit');
        $getStyle = $this->request->getQuery('style');
        $getPackage = $this->request->getQuery('package');
        if ($this->request->is(['get', 'ajax'])) {
            $position = isset($getPosition) ? $getPosition : '';
            $limit = isset($getLimit)?$limit = $getLimit:$limit = 100;
            $style = isset($getStyle) ? $getStyle : '';
            $setpackage = isset($getPackage) ? $getPackage : '';
            // $this->log($setpackage, 'debug');
            if($setpackage == 'a') {
                $package = 'Banner A';
            }else if($setpackage == 'b') {
                $package = 'Banner B';
            }else if($setpackage == 'c') {
                $package = 'Banner C';
            }
            // $this->log($package, 'debug');
            if ($position != '') {
                $q = $this->BannerLines->find('all')
                        ->contain(['Banners' => ['Positions', 'Payments' => ['Packages']], 'Images'])
                        ->where(['Positions.position' => $position, 'banner_lines.isactive' => 'Y', 'Payments.status' => 'CO', 'Packages.name' => $package])
                        ->order(['RAND()'])
                        ->limit($limit);
                $banner_line = $q->toArray();
                if (sizeof($banner_line) > 0) {
                    $data['status'] = 200;
                    $data['bannerlinelist'] = $banner_line;
                } else {
                    $packages = $this->Packages->find()->where(['name' => $package])->first();
                    $data['status'] = 100;
                    $data['message'] = $packages;
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

    public function loadBannerAd() {
        $data = ['message' => '', 'status' => 400];
        if ($this->request->is(['get', 'ajax'])) {
            $getPackage = $this->request->getQuery('package');
            $setpackage = isset($getPackage) ? $getPackage : '';
            // $this->log($setpackage, 'debug');
            if($setpackage == 'a') $packageType = 'Banner A';
            if($setpackage == 'b') $packageType = 'Banner B';
            if($setpackage == 'c') $packageType = 'Banner C';

            $banners = $this->Banners->find('all')
                        ->contain(['Images'])
                        ->where(['Banners.status' => 'CO', 'Banners.type' => $packageType])
                        ->order(['RAND()'])
                        ->limit(10)
                        ->toArray();
            if(sizeof($banners) > 0) {
                $banner_img = [];
                foreach ($banners as $banner) {
                    array_push($banner_img, $banner->image->url);
                }
                $data['status'] = 200;
                $data['bannerlinelist'] = $banner_img;
                $data['bannertype'] = $packageType;
            }else{
                $data['status'] = 404;
            }
        }else{
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function saveimage () {
        $data = ['message' => '', 'status' => 400];
        $postData = $this->request->getData();

        if ($this->request->is(['post', 'ajax'])) {
            $checkbanner = $this->Banners->find()->where(['payment_id' => $postData['payment_id']])->first();
            if(sizeof($checkbanner) > 0){
                $banner_line = $this->BannerLines->newEntity();
                $banner_line = $this->BannerLines->patchEntity($banner_line, $postData);
                $banner_line->banner_id = $checkbanner->id;
                $banner_line->isactive = 'N';

                if($postData['image_id']['tmp_name'] !=''){
                    $this->loadComponent('UploadImage');
                    $imageId = $this->UploadImage->uploadBanner($postData['image_id']);
                    if ($imageId) {
                        $banner_line->image_id = $imageId['image_id'];
                    } else {
                        $data['status'] = 400;
                        $data['message'] = "size banner image not 1500x400 px.";
                    }
                    
                }

                if($this->BannerLines->save($banner_line)){
                    $checkbanner->payment_id = $postData['payment_id'];
                    $this->Banners->save($checkbanner);
                    $data['status'] = 200;
                    $data['message'] = "Insert banner image success.";
                } else {
                    $data['status'] = 400;
                    $data['message'] = "Insert banner image failed.";
                }
            } else {
                $banner = $this->Banners->newEntity();
                $banner = $this->Banners->patchEntity($banner, $postData);
                $banner->user_id = $postData['user_id'];
                $banner->limit = 10;

                if($this->Banners->save($banner)) {
                    $banner_line = $this->BannerLines->newEntity();
                    $banner_line = $this->BannerLines->patchEntity($banner_line, $postData);
                    $banner_line->banner_id = $banner->id;
                    $banner_line->isactive = 'N';

                    if($postData['image_id']['tmp_name'] !=''){
                        $this->loadComponent('UploadImage');
                        $imageId = $this->UploadImage->uploadBanner($postData['image_id']);
                        $banner_line->image_id = $imageId['image_id'];
                    }

                    if($this->BannerLines->save($banner_line)){
                        $data['status'] = 200;
                        $data['message'] = "Insert banner image success.";
                    } else {
                        $data['status'] = 400;
                        $data['message'] = "Insert banner image failed.";
                    }
                }else{
                    $data['status'] = 400;
                    $data['message'] = "could not be inserted.";
                }
            }
        } else {
            $data['message'] = "incorrect method.";
        }
    }

    public function deleteimage () {
        $data = ['message' => '', 'status' => 400];
        $this->request->allowMethod(['post', 'delete']);
        $id = $this->request->getQuery('id');

        $banner_line = $this->BannerLines->get($id);
        if ($this->BannerLines->delete($banner_line)) {
            $data['status'] = 200;
            $data['message'] = 'รูปภาพ Banner ถูกลบแล้ว...';
        } else {
            $data['message'] = 'เกิดข้อผิดพลาด ไม่สามารถลบ Banner ได้!! กรุณาลองใหม่ในภายหลัง...';
        }
    }

    public function checkCreditBanner () {
        $data = ['message' => '', 'status' => 400];
        $this->request->allowMethod(['get', 'ajax']);
        $user_id = $this->request->getQuery('id');

        $user_package = $this->UserPackages->find()->contain(['UserPackageLines'])->where(['user_id' => $user_id, 'user_packages.credit >' => 'user_packages.used'])->toArray();
        if(sizeof($user_package) > 0) {
            $data['status'] = 200;
            $data['isUserPackage'] = $user_package;
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function saveAndUploadBanner() {
        $data = ['message' => '', 'status' => 400];

        if ($this->request->is(['post', 'ajax'])) {
            $postData = $this->request->getData();

            $banner = $this->Banners->newEntity();
            $banner->type = $postData['type'];
            $banner->user_id = $postData['user_id'];
            $banner->user_package_id = $postData['package_id'];
            $banner->topic = $postData['topic'];
            $banner->description = $postData['description'];

            if($postData['image']['tmp_name'] !=''){
                $this->loadComponent('UploadImage');
                $imageId = $this->UploadImage->uploadBanner($postData['image']);
                if ($imageId) {
                    $banner->image_id = $imageId['image_id'];
                } else {
                    $data['status'] = 400;
                    $data['message'] = "banner upload error";
                }
            }

            if($this->Banners->save($banner)) {
                $user_package = $this->UserPackages->get($postData['package_id']);
                $used = $user_package->used + 1;
                $user_package->used = $used;
                if($this->UserPackages->save($user_package)) {
                    $data['status'] = 200;
                    $data['message'] = 'Complete.';
                }else{
                    $data['message'] = 'Error package used update.';
                }
            }else{
                $data['message'] = 'Error banner upload.';
            }

        }else{
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function loadBannerToMyAccount() {
        $data = ['message' => '', 'status' => 400];

        if ($this->request->is(['get', 'ajax'])) {
            $user_id = $this->request->getQuery('user');
            $user_banners = $this->Banners->find()->contain(['Images', 'UserPackages' => ['UserPackageLines']])->where(['Banners.user_id' => $user_id, 'Banners.status' => 'CO'])->toArray();
            if(sizeof($user_banners) > 0) {
                $data['status'] = 200;
                $data['banners'] = $user_banners;
            }else{
                $data['status'] = 404;
                $data['message'] = 'No Data.';
            }
        }else{
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function updateBannerImage() {
        $data = ['message' => '', 'status' => 400];

        if($this->request->is(['post', 'ajax'])) {
            $postData = $this->request->getData();

            $banner = $this->Banners->get($postData['id']);
            $banner->topic = $postData['topic'];
            $banner->description = $postData['description'];
            if($postData['image'] != '') {
                $this->loadComponent('UploadImage');
                $imageId = $this->UploadImage->uploadBanner($postData['image']);
                if ($imageId) {
                    $banner->image_id = $imageId['image_id'];
                } else {
                    $data['status'] = 400;
                    $data['message'] = "banner image upload error";
                }
            }

            if($this->Banners->save($banner)) {
                $data['status'] = 200;
            }
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function deleteBannerImage() {
        $data = ['message' => '', 'status' => 400];

        if($this->request->is(['get', 'ajax'])) {
            $banner = $this->Banners->get($this->request->getQuery('id'));
            $package = $this->UserPackages->get($banner->user_package_id);
            $usedNow = $package->used;
            $banner->status = 'CX';
            $package->used = $package->used - 1;

            if($this->Banners->save($banner) && $this->UserPackages->save($package)) {
                $data['status'] = 200;
            }else{
                $banner->status = 'CO';
                $package->used = $usedNow;
                $this->Banners->save($banner);
                $this->UserPackages->save($package);
                $data['message'] = 'Error.';
            }
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

}
