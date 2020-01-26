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
            if (isset($allVariable['category']) && $allVariable['category'] != '') {
                
            }
            if (isset($allVariable['asset_type']) && $allVariable['asset_type'] != '') {
                $spl = explode(',', $allVariable['asset_type']);
                $assetTypeCondition = '';
                foreach ($spl as $item) {
                    $assetTypeCondition .= '"' . $item . '",';
                }
                $assetTypeCondition = rtrim($assetTypeCondition, ',');
                $condition .= ' and assets.asset_type_id in (' . $assetTypeCondition . ')';
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
            if (isset($allVariable['subdistrict']) && $allVariable['subdistrict'] != '') {
                
            }
            if (isset($allVariable['district']) && $allVariable['district'] != '') {
                
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
            $sql = 'select assets.id,assets.name,assets.isactive,assets.status,DATE_FORMAT(assets.created,"%d/%m/%Y เวลา %H:%i") as created   
                            from assets
                            LEFT JOIN users ON user_id = users.id
                            LEFT JOIN asset_types ON asset_type_id = asset_types.id
                            LEFT JOIN asset_categories ON asset_category_id = asset_categories.id
                            LEFT JOIN addresses ON address_id = addresses.id
                        WHERE ' . $condition . '
                       
                    ORDER BY ' . $_order;
            $sql2 = 'select assets.id,assets.name,assets.isactive,assets.status,DATE_FORMAT(assets.created,"%d/%m/%Y เวลา %H:%i") as created   
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
                        $this->log($q,'debug');
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

    public function uploadAssetImage() {
        $data = ['message' => '', 'status' => 400];
        $asset_id = $this->request->getQuery('id');
        if ($this->request->is(['post', 'ajax'])) {
            $this->loadComponent('UploadImage');
            $postData = $this->request->getData();
            $this->log($postData, 'debug');
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

}
