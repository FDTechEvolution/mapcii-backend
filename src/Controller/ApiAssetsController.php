<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * ApiAuthen Controller
 *
 *
 * @method \App\Model\Entity\ApiAuthen[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApiAssetsController extends AppController {

    public $Assets = null;
    public $Options = null;
    public $AssetTypes = null;
    public $Connection = null;
    public $AssetOptions = null;
    public $AssetImages = null;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
        $this->viewBuilder()->setLayout('ajax');

        $this->Assets = TableRegistry::get('Assets');
        $this->Options = TableRegistry::get('Options');
        $this->AssetTypes = TableRegistry::get('AssetTypes');
        $this->AssetImages = TableRegistry::get('AssetImages');
        $this->AssetAds = TableRegistry::get('AssetAds');

        $this->Connection = ConnectionManager::get('default');
    }

    public function avaliableAsset() {
        $data = ['message' => '', 'status' => 400, 'list' => []];
        $orderByCondition = 'assets.created';
        $condition = 'assets.status = "CO"';
        $limit = '';
        $allVariable = $this->request->getQueryParams();

        if ($this->request->is(['get', 'ajax'])) {

            //$this->log($allVariable, 'debug');
            if (isset($allVariable['issales']) && $allVariable['issales'] != '') {
                $condition .= ' and assets.issales ="' . $allVariable['issales'] . '"';
            }
            if (isset($allVariable['isrent']) && $allVariable['isrent'] != '') {
                $condition .= ' and assets.isrent ="' . $allVariable['isrent'] . '"';
            }
            if (isset($allVariable['isnewproject']) && $allVariable['isnewproject'] != '') {
                $condition .= ' and assets.isnewproject ="' . $allVariable['isnewproject'] . '"';
            }
            if (isset($allVariable['category']) && $allVariable['category'] != '') {
                
            }
            if (isset($allVariable['search_asset_type_id']) && $allVariable['search_asset_type_id'] != '') {
                // $this->log($allVariable['search_asset_type_id'], 'debug');
                $spl = explode(',', $allVariable['search_asset_type_id']);
                $assetTypeCondition = '';
                foreach ($spl as $item) {
                    $assetTypeCondition .= '"' . $item . '",';
                }
                $assetTypeCondition = rtrim($assetTypeCondition, ',');
                $condition .= ' and assets.asset_type_id in (' . $assetTypeCondition . ')';
                // $this->log($assetTypeCondition, 'debug');
            }
            if (isset($allVariable['user']) && $allVariable['user'] != '') {
                
            }
            if (isset($allVariable['orderby']) && $allVariable['orderby'] != '') {
                $orderby = $allVariable['orderby'];
                //$_orderbyCondition = '';
                if ($orderby == 'land_size_asc') {
                    $orderByCondition = 'assets.landsize ASC';
                } else if ($orderby == 'land_size_desc') {
                    $orderByCondition = 'assets.landsize DESC';
                } else if ($orderby == 'date') {
                    $orderByCondition = 'assets.created ASC';
                }else if ($orderby == 'datedesc') {
                    $orderByCondition = 'assets.created DESC';
                }else if ($orderby == 'bedroom') {
                    $orderByCondition = 'assets.bedroom ASC';
                } else if ($orderby == 'price_asc') {
                    $orderByCondition = 'assets.price ASC';
                }else if ($orderby == 'price_desc') {
                    $orderByCondition = 'assets.price DESC';
                }
                
                
            }
            if (isset($allVariable['search_sub_district_id']) && $allVariable['search_sub_district_id'] != '') {
                $condition .= ' and ad.subdistrict_id ="' . $allVariable['search_sub_district_id'] . '"';
            }
            if (isset($allVariable['search_district_id']) && $allVariable['search_district_id'] != '') {
                $condition .= ' and ad.district_id ="' . $allVariable['search_district_id'] . '"';
            }
            if (isset($allVariable['province']) && $allVariable['province'] != '') {
                $condition .= ' and ad.province_id ="' . $allVariable['province'] . '"';
            }
            if (isset($allVariable['price_start']) && $allVariable['price_start'] != '') {
                $condition .= ' and assets.price >= ' . $allVariable['price_start'];
            }
            if (isset($allVariable['price_end']) && $allVariable['price_end'] != '') {
                $condition .= ' and assets.price <=' . $allVariable['price_end'];
            }

            if (isset($allVariable['limit']) && $allVariable['limit'] != '') {
                $limit .= ' limit ' . $allVariable['limit'];
            }

            /*
              $_category = $this->request->getQuery('category');
              $_type = $this->request->getQuery('type');
              $_issale = $this->request->getQuery('issales');
              $_user = $this->request->getQuery('user');
              $getorder = $this->request->getQuery('order');
              $_subdistrict = $this->request->getQuery('subdistrict');
              $_district = $this->request->getQuery('district');
              $_province = $this->request->getQuery('province');
              $for = $this->request->getQuery('for');
              $priceStart = $this->request->getQuery('price_start');
              $priceEnd = $this->request->getQuery('price_end');
              $isNewProject = $this->request->getQuery('isnewproject');
              $searchText = $this->request->getQuery('search_text');
              $category = isset($_category) ? $_category : '';
              $type = isset($_type) ? $_type : '';
              $issale = isset($_issale) ? $_issale : '';
              $user = isset($_user) ? $_user : '';
              $order = isset($getorder) ? $getorder : '';
              $subdistrict = isset($_subdistrict) ? $_subdistrict : '';
              $district = isset($_district) ? $_district : '';
              $province = isset($_province) ? $_province : '';

              if ($order != '') {
              if ($order == 'land_size_asc') {
              $_order = 'assets.landsize ASC';
              } else if ($order == 'land_size_desc') {
              $_order = 'assets.landsize DESC';
              } else if ($order == 'date') {
              $_order = 'assets.created ASC';
              } else if ($order == 'bedroom') {
              $_order = 'assets.bedroom ASC';
              } else if ($order == 'price') {
              $_order = 'asset.price ASC';
              }
              }

              if(!is_null($searchText) && $searchText !=''){
              $condition .= ' and assets.name LIKE "%' . $searchText.'%"' ;
              }

              if (!is_null($priceStart) && $priceStart !='') {
              $condition .= ' and assets.price >=' . $priceStart ;
              }
              if (!is_null($priceEnd) && $priceEnd !='') {
              $condition .= ' and assets.price <=' . $priceEnd ;
              }

              if ($category != '') {
              $condition .= ' and asset_categories.id ="' . $category . '"';
              }

              if ($issale != '') {
              $condition .= ' and assets.issales ="' . $issale . '"';
              }
              if ($user != '') {
              $condition .= ' and users.id ="' . $user . '"';
              }
              if ($subdistrict != '') {
              $condition .= ' and ad.subdistrict_id ="' . $subdistrict . '"';
              }
              if ($district != '') {
              $condition .= ' and ad.district_id ="' . $district . '"';
              }
              if ($type != '') {
              $spl = explode(',', $type);
              $inCondition = '';

              foreach ($spl as $key => $value) {
              if($key ==0){
              $inCondition = "'".$value."'";
              }else{
              $inCondition = $inCondition.","."'".$value."'";
              }
              }
              $condition .= ' and asset_types.id IN ('. $inCondition . ')';
              }

              if ($province != '') {

              $spl = explode(',', $province);
              $inCondition = '';

              foreach ($spl as $key => $value) {
              if($key ==0){
              $inCondition = "'".$value."'";
              }else{
              $inCondition = $inCondition.","."'".$value."'";
              }
              }

              $condition .= ' and ad.province_id ="'.$province.'"';
              }

              if(!is_null($for)){
              if($for !='all'){
              $condition .= ' and assets.type ="' . $for . '"';
              }

              }

             */

            $sql = 'select assets.id,assets.name,assets.isactive,assets.status,image.url,
                DATE_FORMAT(assets.created,"%d/%m/%Y เวลา %H:%i") as created,ad.latitude,ad.longitude,
                assets.price,assets.discount,assets.bedroom,assets.bathroom,assets.usefulspace,
                concat(ad.address1,subdistricts.name,districts.name,provinces.name) as address 
                            from assets
                            LEFT JOIN users ON user_id = users.id
                            LEFT JOIN asset_types ON asset_type_id = asset_types.id
                            LEFT JOIN asset_categories ON asset_category_id = asset_categories.id
                            LEFT JOIN addresses ad ON assets.address_id = ad.id 
                            left join provinces on ad.province_id = provinces.id 
                            left join districts on ad.district_id = districts.id 
                            left join subdistricts on ad.subdistrict_id = subdistricts.id 
                            left join (select images.url,aim.asset_id from asset_images aim join images on aim.image_id = images.id where aim.isdefault="Y") as image on assets.id = image.asset_id 
                        
                       WHERE ' . $condition .'  
                    ORDER BY ' . $orderByCondition.$limit;
            //$this->log($sql, 'debug');
            $result = $this->Connection->execute($sql, [])->fetchAll('assoc');

            if (sizeof($result) > 0) {
                $data['status'] = 200;
                $data['list'] = $result;
            } else {
                $data['status'] = 200;
                $data['message'] = "Asset is empty.";
            }
        } else {
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function listassetads () {
        $data = ['message' => '', 'status' => 400];
        if ($this->request->is(['get', 'ajax'])) {
            $getUser = $this->request->getQuery('user');
            $user = isset($getUser) ? $getUser : '';
            $asset_ads = $this->AssetAds->find('all')
                        ->contain(['Assets'])
                        ->where(['Assets.user_id' => $user])
                        ->toArray();
            if(sizeof($asset_ads)) {
                $data['status'] = 200;
                $data['list_ads'] = $asset_ads;
            } else {
                $data['message'] = 'Ads is null.';
            }
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function getlistasset () {
        $data = ['message' => '', 'status' => 400];
        if ($this->request->is(['get', 'ajax'])) {
            $newList = [];
            $newListAds = [];
            $getUser = $this->request->getQuery('user');
            $user = isset($getUser) ? $getUser : '';
            $assets = $this->Assets->find('all')
                        ->where(['user_id' => $user])
                        ->toArray();
            if(sizeof($assets)) {
                foreach($assets as $asset) {
                    $asset_ads = $this->AssetAds->find('all')
                                ->contain(['Assets', 'Payments'])
                                ->where(['AssetAds.asset_id' => $asset->id])
                                ->first();
                    if(sizeof($asset_ads) > 0) {
                        array_push($newListAds,$asset_ads);
                    } else {
                        array_push($newList,$asset);
                    }
                }
                $data['status'] = 200;
                $data['list'] = $newList;
                $data['ads'] = $newListAds;
            } else {
                $data['message'] = 'Ads is null.';
            }
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function listassetaddress () {
        $data = ['message' => '', 'status' => 400];
        $imgAsset = [];
        $imgAds = [];
        $listAsset = [];
        $adsAsset = [];
        $getType = [];
        if ($this->request->is(['get', 'ajax'])) {
            $getSale = $this->request->getQuery('issales');
            $getRent = $this->request->getQuery('isrent');
            $getNewProject = $this->request->getQuery('isnewproject');
            // $this->log($getNewProject, 'debug');
            $getType = $this->request->getQuery('type');
            // $this->log($getType, 'debug');
            if(isset($getType) && $getType != '') {
                $array_type = [];
                $type = '';
                $spl = explode(',', $getType);
                foreach ($spl as $item) {
                    array_push($array_type,$item);
                }
                $type = (['Assets.asset_type_id IN' => $array_type]);
            }else{
                $type = '';
            }
            // $this->log($type, 'debug');
            // $getText = $this->request->getQuery('search_text');
            $getProvince = $this->request->getQuery('province');
            // $this->log($getProvince, 'debug');
            $getDistrict = $this->request->getQuery('search_district_id');
            $getSubdistrict = $this->request->getQuery('search_sub_district_id');
            $getPriceStart = $this->request->getQuery('price_start');
            $getPriceEnd = $this->request->getQuery('price_end');

            $sales = ($getSale != 'null' && $getSale != '') ? (['Assets.issales' => $getSale]) : '';
            $rent = ($getRent != 'null' && $getRent != '') ? (['Assets.isrent' => $getRent]) : '';
            $newproject = ($getNewProject != 'null' && $getNewProject != '') ? (['Assets.isnewproject' => $getNewProject]) : '';
            // $this->log($sales, 'debug');
            // $this->log($newproject, 'debug');
            // $type = ($getType != 'null' && $getType != '') ? (['Assets.asset_type_id' => $getType]) : '';
            // $text = ($getText != '' ? (['Assets.asset_type_id' => $getText]) : '');
            $province = ($getProvince != 'null' && $getProvince != '') ? (['Addresses.province_id' => $getProvince]) : '';
            $district = ($getDistrict != 'null' && $getDistrict != '') ? (['Addresses.district_id' => $getDistrict]) : '';
            $subdistrict = ($getSubdistrict != 'null' && $getSubdistrict != '') ? (['Addresses.subdistrict_id' => $getSubdistrict]) : '';
            $pricestart = ($getPriceStart != 'null' && $getPriceStart != '') ? (['Assets.price >=' => $getPriceStart]) : (['Assets.price >=' => '0']);
            $priceend = ($getPriceEnd != 'null' && $getPriceEnd != '') ? (['Assets.price <=' => $getPriceEnd]) : (['Assets.price <=' => '1000000000']);

            // $this->log($type, 'debug');
            // $this->log($district, 'debug');
            $asset_address = $this->Assets->find('all')
                            ->contain(['Addresses' => ['Provinces']])
                            ->where([$sales, $rent, $newproject, $province, $district, $subdistrict, $pricestart, $priceend])
                            ->where([$type])
                            ->toArray();
            // $this->log($asset_address, 'debug');
            if(sizeof($asset_address) > 0) {
                foreach($asset_address as $asset){
                    $asset_ads = $this->AssetAds->find('all')
                                ->contain(['Assets' => ['Addresses' => ['Provinces']], 'Payments', 'Positions'])
                                ->where(['AssetAds.asset_id' => $asset->id, 'Payments.status' => 'CO'])
                                ->first();
                    if(sizeof($asset_ads) > 0) {
                        array_push($imgAds,$this->getimglistaddress($asset->id));
                        array_push($adsAsset,$asset_ads);
                    } else {
                        array_push($imgAsset,$this->getimglistaddress($asset->id));
                        array_push($listAsset,$asset);
                    }
                }
                    $data['status'] = 200;
                    $data['list'] = $listAsset;
                    $data['ads'] = $adsAsset;
                    $data['image'] = $imgAsset;
                    $data['imgads'] = $imgAds;
            } else {
                $this->Provinces = TableRegistry::get('Provinces');
                $asset_position = $this->Provinces->find('all')->where(['id' => $getProvince])->first();
                $data['status'] = 400;
                $data['message'] = "Asset is empty.";
                $data['position'] = $asset_position;
            }
        } else {
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    private function getimglistaddress ($asset_id) {
        $asset_image = $this->AssetImages->find('all')
                    ->contain(['Images'])
                    ->where(['asset_id' => $asset_id, 'isdefault' => 'Y'])
                    ->order(['AssetImages.created' => 'DESC'])
                    ->first();
        return $image_url['img_url'] = $asset_image->image->url;
    }

    public function loadassetads () {
        $data = ['message' => '', 'status' => 400];
        $provinces = [];
        $districts = [];
        $getType = [];
        $imgProvince = [];
        $imgDistrict = [];
        if ($this->request->is(['get', 'ajax'])) {
            $getSale = $this->request->getQuery('issales');
            $getRent = $this->request->getQuery('isrent');
            $getNewProject = $this->request->getQuery('isnewproject');
            $getType = $this->request->getQuery('type');
            // $this->log($getType, 'debug');
            if(isset($getType) && $getType != '') {
                $array_type = [];
                $type = '';
                $spl = explode(',', $getType);
                foreach ($spl as $item) {
                    array_push($array_type,$item);
                }
                $type = (['Assets.asset_type_id IN' => $array_type]);
            }else{
                $type = '';
            }
            // $this->log($type, 'debug');
            // $getText = $this->request->getQuery('search_text');
            $getProvince = $this->request->getQuery('province');
            $getDistrict = $this->request->getQuery('search_district_id');
            $getSubdistrict = $this->request->getQuery('search_sub_district_id');
            $getPriceStart = $this->request->getQuery('price_start');
            $getPriceEnd = $this->request->getQuery('price_end');

            $sales = ($getSale != 'null' && $getSale != '') ? (['Assets.issales' => $getSale]) : '';
            $rent = ($getRent != 'null' && $getRent != '') ? (['Assets.isrent' => $getRent]) : '';
            $newproject = ($getNewProject != 'null' && $getNewProject != '') ? (['Assets.isnewproject' => $getNewProject]) : '';
            // $type = ($getType != 'null' && $getType != '') ? (['Assets.asset_type_id' => $getType]) : '';
            // $this->log($type, 'debug');
            // $text = ($getText != '' ? (['Assets.asset_type_id' => $getText]) : '');
            $province = ($getProvince != 'null' && $getProvince != '') ? (['Addresses.province_id' => $getProvince]) : '';
            $district = ($getDistrict != 'null' && $getDistrict != '') ? (['Addresses.district_id' => $getDistrict]) : '';
            $subdistrict = ($getSubdistrict != 'null' && $getSubdistrict != '') ? (['Addresses.subdistrict_id' => $getSubdistrict]) : '';
            $pricestart = ($getPriceStart != 'null' && $getPriceStart != '') ? (['Assets.price >=' => $getPriceStart]) : (['Assets.price >=' => '0']);
            $priceend = ($getPriceEnd != 'null' && $getPriceEnd != '') ? (['Assets.price <=' => $getPriceEnd]) : (['Assets.price <=' => '1000000000']);

            $asset_ads = $this->AssetAds->find('all')
                            ->contain(['Assets' => ['Addresses'], 'Payments', 'Positions'])
                            ->order(['AssetAds.modified' => 'DESC'])
                            ->where([$sales, $rent, $newproject, $province, $district, $subdistrict, $pricestart, $priceend, 'Payments.status' => 'CO'])
                            ->where([$type])
                            ->limit(5)
                            ->toArray();
            // $this->log($type, 'debug');
            // $this->log($asset_ads, 'debug');
            if(sizeof($asset_ads) > 0) {
                foreach($asset_ads as $ads){
                    if($ads->position->position == 'province'){
                        array_push($provinces, $ads);
                        array_push($imgProvince, $this->getimglistasset($ads->asset->id));
                    }else if($ads->position->position == 'district'){
                        array_push($districts, $ads);
                        array_push($imgDistrict, $this->getimglistasset($ads->asset->id));
                    }
                }
                $data['status'] = 200;
                $data['listprovince'] = $provinces;
                $data['listdistrict'] = $districts;
                $data['imgprovince'] = $imgProvince;
                $data['imgdistrict'] = $imgDistrict;
            }
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function upAssetToFirst () {
        $data = ['message' => '', 'status' => 400];
        if ($this->request->is(['post', 'ajax'])) {
            $postData = $this->request->getData();
            $assetUp = $this->AssetAds->find()->where(['payment_id' => $postData['id']])->first();
            $assetUp->status = 'UP';
            if($this->AssetAds->save($assetUp)) {
                $data['status'] = 200;
                $data['message'] = 'อัพเดทอันดับประกาศของคุณในวันนี้แล้ว...';
            }else{
                $data['message'] = 'อัพเดทอันดับประกาศของคุณเกิดข้อผิดพลาด กรุณาลองใหม่...';
            }
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function downAllAssets () {
        if ($this->request->is(['post', 'ajax'])) {
            $postData = $this->request->getData();
            $assetDown = $this->AssetAds->find('all')->where(['status' => 'UP'])->toArray();
            if(sizeof($assetDown) > 0){
                foreach($assetDown as $asset_down) {
                    $asset_down->status = 'DW';
                    $this->AssetAds->save($asset_down);
                }
            }
        }
    }

    public function checkPublish () {
        if ($this->request->is(['get', 'ajax'])) {
            // $postData = $this->request->getData();
            $date_now = date('Y-m-d');
            $assets = $this->Assets->find('all')->where(['status' => 'DR'])->toArray();
            if(sizeof($assets) > 0) {
                foreach($assets as $asset) {
                    if($asset->startdate == $date_now) {
                        $asset->status = 'CO';
                        $this->Assets->save($asset);
                    }
                }
            }
        }
    }

    public function checkDueDate () {
        if ($this->request->is(['get', 'ajax'])) {
            // $postData = $this->request->getData();
            $date_now = date('Y-m-d');
            $assets = $this->Assets->find('all')->where(['status' => 'CO'])->toArray();
            if(sizeof($assets) > 0) {
                foreach($assets as $asset) {
                    $duedate = date('Y-m-d', strtotime($asset->startdate. ' + '. $asset->total_publish_date .'days'));
                    if($date_now >= $duedate) {
                        $asset->status = 'EX';
                        $this->Assets->save($asset);
                    }
                }
            }
        }
    }
    
    public function loadassets() {
        $data = ['message' => '', 'status' => 400];
        $provinces = [];
        $districts = [];
        $getType = [];
        $imgAssets = [];
        if ($this->request->is(['get', 'ajax'])) {
            $getSale = $this->request->getQuery('issales');
            $getRent = $this->request->getQuery('isrent');
            $getNewProject = $this->request->getQuery('isnewproject');
            $getType = $this->request->getQuery('type');
            if(isset($getType) && $getType != '') {
                $array_type = [];
                $type = '';
                $spl = explode(',', $getType);
                foreach ($spl as $item) {
                    array_push($array_type,$item);
                }
                $type = (['Assets.asset_type_id IN' => $array_type]);
            }else{
                $type = '';
            }
            $getProvince = $this->request->getQuery('province');
            $getDistrict = $this->request->getQuery('search_district_id');
            $getSubdistrict = $this->request->getQuery('search_sub_district_id');
            $getPriceStart = $this->request->getQuery('price_start');
            $getPriceEnd = $this->request->getQuery('price_end');

            $sales = ($getSale != 'null' && $getSale != '') ? (['Assets.issales' => $getSale]) : '';
            $rent = ($getRent != 'null' && $getRent != '') ? (['Assets.isrent' => $getRent]) : '';
            $newproject = ($getNewProject != 'null' && $getNewProject != '') ? (['Assets.isnewproject' => $getNewProject]) : '';
            $province = ($getProvince != 'null' && $getProvince != '') ? (['Addresses.province_id' => $getProvince]) : '';
            $district = ($getDistrict != 'null' && $getDistrict != '') ? (['Addresses.district_id' => $getDistrict]) : '';
            $subdistrict = ($getSubdistrict != 'null' && $getSubdistrict != '') ? (['Addresses.subdistrict_id' => $getSubdistrict]) : '';
            $pricestart = ($getPriceStart != 'null' && $getPriceStart != '') ? (['Assets.price >=' => $getPriceStart]) : (['Assets.price >=' => '0']);
            $priceend = ($getPriceEnd != 'null' && $getPriceEnd != '') ? (['Assets.price <=' => $getPriceEnd]) : (['Assets.price <=' => '1000000000']);

            $assets = $this->Assets->find('all')
                            ->contain(['Addresses'])
                            ->order(['Assets.created' => 'DESC'])
                            ->where([$sales, $rent, $newproject, $province, $district, $subdistrict, $pricestart, $priceend, 'status' => 'CO'])
                            ->where([$type])
                            ->limit(20)
                            ->toArray();
                            $this->log($assets, 'debug');
            if(sizeof($assets) > 0) {
                foreach ($assets as $asset) {
                    array_push($imgAssets, $this->getimglistasset($asset->id));
                }
                $data['status'] = 200;
                $data['listasset'] = $assets;
                $data['imgasset'] = $imgAssets;
            }
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    private function getimglistasset ($asset_id) {
        $asset_image = $this->AssetImages->find('all')
                    ->contain(['Images'])
                    ->where(['asset_id' => $asset_id, 'isdefault' => 'Y'])
                    ->order(['AssetImages.created' => 'DESC'])
                    ->first();
        return $image_url['img_url'] = $asset_image->image->url;
    }

    public function assetFavorite () {
        $data = ['message' => '', 'status' => 400];

        if ($this->request->is(['get', 'ajax'])) {
            $this->UserFavorites = TableRegistry::get('UserFavorites');
            $user_id = $this->request->getQuery('id');
            $favorite_array = [];

            $favorites = $this->UserFavorites->find('all')->where(['user_id' => $user_id])->toArray();
            if(sizeof($favorites) > 0) {
                foreach($favorites as $favorite){
                    array_push($favorite_array, $favorite->asset_id);
                }
                $data['status'] = 200;
                $data['assetfavorite'] = $favorite_array;
            }
        }
        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function listassetimage () {
        $data = ['message' => '', 'status' => 400];
        if ($this->request->is(['get', 'ajax'])) {
            $getId = $this->request->getQuery('id');
            $id = isset($getId) ? $getId : '';
            $asset_image = $this->AssetImages->find('all')
                            ->contain(['Images'])
                            ->where(['asset_id' => $id])
                            ->toArray();
            if(sizeof($asset_image) > 0) {
                $data['status'] = 200;
                $data['list'] = $asset_image;
            } else {
                $data['status'] = 200;
                $data['message'] = "Asset is empty.";
            }
        } else {
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function listasset() {
        $data = ['message' => '', 'status' => 400];
        $_order = 'assets.created';
        $where = '';
        $condition = '';
        if ($this->request->is(['get', 'ajax'])) {
            $_category = $this->request->getQuery('category');
            $_type = $this->request->getQuery('type');
            $_issale = $this->request->getQuery('issale');
            $_user = $this->request->getQuery('user');
            $getorder = $this->request->getQuery('order');
            $_subdistrict = $this->request->getQuery('subdistrict');
            $_district = $this->request->getQuery('district');
            $_province = $this->request->getQuery('province');
            $category = isset($_category) ? $_category : '';
            $type = isset($_type) ? $_type : '';
            $issale = isset($_issale) ? $_issale : '';
            $user = isset($_user) ? $_user : '';
            $order = isset($getorder) ? $getorder : '';
            $subdistrict = isset($_subdistrict) ? $_subdistrict : '';
            $district = isset($_district) ? $_district : '';
            $province = isset($_province) ? $_province : '';
            /// ck order
            if ($order != '') {
                if ($order == 'type') {
                    $_order = 'asset_types.name';
                } else if ($order == 'date') {
                    $_order = 'assets.created';
                } else if ($order == 'category') {
                    $_order = 'asset_categories.name';
                } else if ($order == 'price') {
                    if ($issale == 'Y') {
                        $_order = 'asset.price_sales';
                    } else {
                        $_order = 'asset.price_rent';
                    }
                }
            }
            //////
            if ($category != '') {
                $condition .= ' asset_categories.id ="' . $category . '"';
            }
            if ($type != '') {
                $condition .= ($condition != '' ? ' AND ' : '') . ' asset_types.id ="' . $type . '"';
            }
            if ($issale != '') {
                $condition .= ($condition != '' ? ' AND ' : '') . ' asset.issale ="' . $issale . '"';
            }
            if ($user != '') {
                $condition .= ($condition != '' ? ' AND ' : '') . ' users.id ="' . $user . '"';
            }
            if ($subdistrict != '') {
                $condition .= ($condition != '' ? ' AND ' : '') . ' addresses.subdistrict_id ="' . $subdistrict . '"';
            }
            if ($district != '') {
                $condition .= ($condition != '' ? ' AND ' : '') . ' addresses.district_id ="' . $district . '"';
            }
            if ($province != '') {
                $condition .= ($condition != '' ? ' AND ' : '') . ' addresses.province_id ="' . $province . '"';
            }
            //  $this->log($condition, 'debug');
            $sql = 'select assets.id,assets.name,assets.isactive,assets.status,assets.isnewproject,assets.issales,assets.isrent,DATE_FORMAT(assets.created,"%d/%m/%Y เวลา %H:%i") as created   
                            from assets
                            LEFT JOIN users ON user_id = users.id
                            LEFT JOIN asset_types ON asset_type_id = asset_types.id
                            LEFT JOIN asset_categories ON asset_category_id = asset_categories.id
                            LEFT JOIN addresses ON address_id = addresses.id
                        WHERE ' . $condition . '
                       
                    ORDER BY ' . $_order;
            $sql2 = 'select assets.id,assets.name,assets.isactive,assets.status,assets.isnewproject,assets.issales,assets.isrent,DATE_FORMAT(assets.created,"%d/%m/%Y เวลา %H:%i") as created   
                            from assets
                            LEFT JOIN users ON user_id = users.id
                            LEFT JOIN asset_types ON asset_type_id = asset_types.id
                            LEFT JOIN asset_categories ON asset_category_id = asset_categories.id
                            LEFT JOIN addresses ON address_id = addresses.id
                        
                       
                    ORDER BY ' . $_order;

            //  $result = $this->Connection->execute($sql, [])->fetchAll('assoc');
            //   $this->log($sql, 'debug');
            if ($category == '' && $type == '' && $issale == '' && $user == '' && $subdistrict == '' && $district == '' && $province == '') {
                $result = $this->Connection->execute($sql2, [])->fetchAll('assoc');
            } else {
                $result = $this->Connection->execute($sql, [])->fetchAll('assoc');
            }

            if (sizeof($result) > 0) {
                $data['status'] = 200;
                $data['list'] = $result;
            } else {
                $data['status'] = 200;
                $data['message'] = "Asset is empty.";
            }
        } else {
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }


    public function create() {
        $data = ['message' => '', 'status' => 400, 'asset' => null];

        if ($this->request->is(['post', 'ajax'])) {
            $this->loadComponent('Sequent');

            $postData = $this->request->getData();
            $asset = null;
            if (isset($postData['asset_id']) && $postData['asset_id'] != null && $postData['asset_id'] != '') {
                $asset = $this->Assets->get($postData['asset_id']);
            } else {
                $asset = $this->Assets->newEntity();

                $address = $this->Assets->Addresses->newEntity();
                $address->ishasmap = 'N';
                $this->Assets->Addresses->save($address);
                $asset->address_id = $address->id;
            }
            //$this->log($postData,'debug');
            $asset = $this->Assets->patchEntity($asset, $postData);
            if (is_null($asset->code)) {
                $code = $this->Sequent->getNextSequent();
                $asset->code = $code;
            }

            $asset->startdate = $this->Util->convertDate($postData['startdate']);

            if ($this->Assets->save($asset)) {
                $data['status'] = 200;
                $data['message'] = "Created success.";
                $asset = $this->Assets->get($asset->id);

                $data['data'] = $asset;
            } else {
                $data['status'] = 400;
                $data['message'] = $asset->errors();
            }
        } else {
            $data['message'] = "incorrect method.";
        }
        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function update() {
        $data = ['message' => '', 'status' => 400];
        $id = $this->request->getQuery('id');
        //  $this->log($id, 'debug');
        if ($this->request->is(['post', 'ajax'])) {

            if (!is_null($id) && $id != '') {
                $asset = $this->Assets->get($id);
                $postData = $this->request->getData();

                $asset = $this->Assets->patchEntity($asset, $postData);
                if (isset($postData['startdate']) && $postData['startdate'] != '') {
                    $asset->startdate = $this->Util->convertDate($postData['startdate']);
                }

                if (isset($postData['isnewproject']) && $postData['isnewproject'] != '') {
                    $asset->isnewproject = 'Y';
                } else {
                    $asset->isnewproject = 'N';
                }


                if ($this->Assets->save($asset)) {
                    $data['status'] = 200;
                    $data['message'] = "Updated success.";
                    $data['data'] = $asset;
                } else {
                    $data['status'] = 400;
                    $data['message'] = $asset->errors();
                }
            } else {
                $data['message'] = "name code asset-type-id and user-id can't be empty.";
            }
        } else {
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function createAssetOption() {
        $data = ['message' => '', 'status' => 400];
        if ($this->request->is(['post', 'ajax'])) {
            $this->AssetOptions = TableRegistry::get('AssetOptions');

            $asset_id = $this->request->getQuery('id');
            if (!is_null($asset_id) && $asset_id != '') {
                $postData = $this->request->getData();
                //$this->log($postData,'debug');
                //clear old item
                $this->AssetOptions->deleteAll(['asset_id' => $asset_id]);
                $saveCount = 0;
                foreach ($postData['asset_option'] as $item) {
                    $assetOption = $this->AssetOptions->newEntity();
                    $assetOption->asset_id = $asset_id;
                    $assetOption->option_id = $item['option_id'];
                    if ($this->AssetOptions->save($assetOption)) {
                        $saveCount++;
                    }
                }
                $data['status'] = 200;
                $data['message'] = 'saved total ' . $saveCount . ' row(s).';
            } else {
                $data['message'] = 'require asset id.';
            }
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function asset() {
        $data = ['message' => '', 'status' => 400];
        $id = $this->request->getQuery('id');
        if ($this->request->is(['get', 'ajax'])) {
            $assetid = isset($id) ? $id : '';

            if ($assetid != '') {
                $q = $this->Assets->find()
                        ->contain(['Users', 'AssetImages' => ['Images'], 'Addresses' => ['Provinces', 'Districts', 'Subdistricts'], 'AssetOptions' => ['Options']])
                        ->where(['Assets.id' => $assetid])
                        ->first();
                        // $this->log($q,'debug');
                if (!is_null($q->startdate) && $q->startdate != '') {
                    $q->startdate = $q->startdate->i18nFormat(DATE_FORMATE, null);
                }

                $data['status'] = 200;
                $data['detail'] = $q;
            } else {
                $data['message'] = "Asset id is empty.";
            }
        } else {
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function option() {
        $data = ['message' => '', 'status' => 400];
        $type = $this->request->getQuery('type');

        $where = [];
        if (!is_null($type)) {
            array_push($where, ['Options.type' => strtoupper($type)]);
        }
        if ($this->request->is(['get', 'ajax'])) {
            $q = $this->Options->find()
                    ->select(['id', 'name'])
                    ->where($where)
                    ->order(['Options.name' => 'ASC']);
            $options = $q->toArray();
            if (sizeof($options) > 0) {


                $data['status'] = 200;
                $data['optionlist'] = $options;
            } else {
                $data['message'] = "Option is empty.";
            }
        } else {
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function category() {
        $data = ['message' => '', 'status' => 400];

        if ($this->request->is(['get', 'ajax'])) {
            $q = $this->AssetTypes->find()
                    ->select(['id', 'name'])
                    ->order(['AssetTypes.name' => 'ASC']);
            $category = $q->toArray();
            if (sizeof($category) > 0) {


                $data['status'] = 200;
                $data['categorylist'] = $category;
            } else {
                $data['message'] = "Option is empty.";
            }
        } else {
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function type() {
        $data = ['message' => '', 'status' => 400];

        if ($this->request->is(['get', 'ajax'])) {
            $q = $this->AssetTypes->find()
                    ->select(['id', 'name'])
                    ->order(['AssetTypes.name' => 'ASC']);
            $assettypes = $q->toArray();
            if (sizeof($assettypes) > 0) {


                $data['status'] = 200;
                $data['types'] = $assettypes;
            } else {
                $data['message'] = "Option is empty.";
            }
        } else {
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function assetImage() {
        $data = ['message' => '', 'status' => 400];
        $asset_id = $this->request->getQuery('id');
        if ($this->request->is(['get'])) {
            $q = $this->AssetImages->find()
                    ->contain(['Images'])
                    ->where(['AssetImages.asset_id' => $asset_id])
                    ->order(['AssetImages.isdefault' => 'ASC']);

            $assetImage = $q->toArray();
            $data['status'] = 200;
            $data['data'] = $assetImage;
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function assetImageList() {
        $data = ['message' => '', 'status' => 400];
        $asset_id = $this->request->getQuery('id');
        if ($this->request->is(['get'])) {
            $q = $this->AssetImages->find()
                    ->contain(['Images'])
                    ->where(['AssetImages.asset_id' => $asset_id, 'AssetImages.isdefault' => 'Y']);

            $assetImage = $q->toArray();
            $data['status'] = 200;
            $data['data'] = $assetImage;
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function uploadAssetImage() {
        $data = ['message' => '', 'status' => 400];
        $asset_id = $this->request->getQuery('id');
        if ($this->request->is(['post', 'ajax'])) {
            $this->loadComponent('UploadImage');
            $postData = $this->request->getData();
            // $this->log($postData, 'debug');
            $file = $postData['image_file'];
            if (!is_null($file['name']) && $file['name'] != '') {
                $asset = $this->Assets->get($asset_id);

                $result = $this->UploadImage->upload($file, 800, 500, $asset->code . '/');
                $image_id = $result['image_id'];

                $assetImage = $this->AssetImages->newEntity();
                $assetImage->asset_id = $asset_id;
                $assetImage->image_id = $image_id;
                $assetImage->isdefault = 'N';
                $assetImage->seq = 1;

                $this->AssetImages->save($assetImage);

                $assetImage = $this->AssetImages->get($assetImage->id, ['contain' => ['Images']]);
                $data['status'] = 200;
                $data['data'] = $assetImage;
            }
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function assetImageToDefault() {
        $data = ['message' => '', 'status' => 400];

        $asset_image_id = $this->request->getQuery('id');
        $asset_id = $this->request->getQuery('asset_id');

        $q = $this->AssetImages->find()
                ->where(['asset_id' => $asset_id, 'isdefault' => 'Y']);
        $assetImages = $q->toArray();
        foreach ($assetImages as $item) {
            $item->isdefault = 'N';
            $this->AssetImages->save($item);
        }

        $assetImage = $this->AssetImages->get($asset_image_id);
        $assetImage->isdefault = 'Y';
        if ($this->AssetImages->save($assetImage)) {
            $data['status'] = 200;
        }


        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function assetImageDelete() {
        $data = ['message' => '', 'status' => 400];
        $asset_image_id = $this->request->getQuery('id');
        $asset_id = $this->request->getQuery('asset_id');

        $assetImage = $this->AssetImages->get($asset_image_id);
        $image = $this->AssetImages->Images->get($assetImage->image_id);
        $this->AssetImages->delete($assetImage);
        if ($this->AssetImages->Images->deleteAll(['id' => $image->id])) {
            $data['status'] = 200;
        }
        $json = json_encode($data);
        $this->set(compact('json'));
    }


    public function fav($user_id = null){
      $data = ['message' => '', 'status' => 200];
      
      $sql = 'select uf.id,a.name,i.url,a.price from user_favorites uf join assets a on uf.asset_id = a.id join asset_images ai on a.id = ai.asset_id and ai.isdefault="Y" join images i on ai.image_id = i.id where uf.user_id = :user_id';

      $result = $this->Connection->execute($sql, ['user_id'=>$user_id])->fetchAll('assoc');
      $json = json_encode($result);
      $this->set(compact('json'));

    }


    public function setassetads () {
        $data = ['message' => '', 'status' => 400];

        if ($this->request->is(['post', 'ajax'])) {
            $postData = $this->request->getData();
            $asset_ads = $this->AssetAds->newEntity();
            $asset_ads = $this->AssetAds->patchEntity($asset_ads, $postData);
            $asset_ads->status = 'DR';

            // $this->log($postData, 'debug');

            // $this->log($asset_ads, 'debug');

            if($this->AssetAds->save($asset_ads)) {
                $data['status'] = 200;
                $data['message'] = 'Asset Ads Saved.';
            } else {
                $data['message'] = 'Asset Ads Failed.';
            }
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

}
