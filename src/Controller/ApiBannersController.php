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
            $this->log($setpackage, 'debug');
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

}
