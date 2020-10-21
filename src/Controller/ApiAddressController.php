<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
/**
 * ApiAddress Controller
 *
 *
 * @method \App\Model\Entity\ApiAddres[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApiAddressController extends AppController {
    
    public $Provinces = null;
    public $Addresses = null;
    
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
        $this->viewBuilder()->setLayout('ajax');

        $this->Provinces = TableRegistry::get('Provinces');
        $this->Addresses  = TableRegistry::get('Addresses');
    }
    
    public function create(){
        if($this->request->is(['post','ajax'])){
            
            
            $postData = $this->request->getData();
            //$this->log($postData,'debug');
            $address = $this->Addresses->newEntity();
            $address = $this->Addresses->patchEntity($address, $postData);
            $address->latitude = $postData['latitude'];
            $address->longitude = $postData['longitude'];
            
            if(!is_null($address->longitude) && $address->longitude !='' 
                    && !is_null($address->latitude) && $address->latitude !=''){
               $address->ishasmap = 'Y';
            }
            
            $data = ['message' => '', 'status' => 400,'data'=>null];
            if($this->Addresses->save($address)){
                $data['status'] = 200;
                $address = $this->Addresses->get($address->id);
                $data['data'] = $address;
            }else{
                $data['message'] = $address->errors();
            }
            
        }
        $json = json_encode($data);
        $this->set(compact('json'));
    }
    
    public function update(){
        $id = $this->request->getQuery('id');
         $data = ['message' => '', 'status' => 400,'data'=>null];
        if($this->request->is(['post','ajax'])){
            $address = $this->Addresses->get($id);
            $postData = $this->request->getData();
            
            $address = $this->Addresses->patchEntity($address, $postData);
            $address->latitude = $postData['latitude'];
            $address->longitude = $postData['longitude'];
            
            $this->log($address,'debug');
            if($this->Addresses->save($address)){
                $data['status'] = 200;
            }else{
                $data['message'] = $address->errors();
            }
        }
        
        $json = json_encode($data);
        $this->set(compact('json'));
    }
    
    public function options(){
        $q = $this->Provinces->find()
                ->select(['id','name'])
                ->contain(['Districts'=>[
                    'fields'=>['id','name','province_id'],
                    'Subdistricts'=>[
                        'fields'=>['id','name','district_id']
                    ]]])
                ->order(['Provinces.name'=>'ASC']);
        $addressOptions = $q->toArray();
        
        $json = json_encode($addressOptions);
        $this->set(compact('json'));
    }

    public function positions() {
        $id = $this->request->getQuery('id');
        $latlng = $this->Provinces->find()
                    ->select(['lat','lng','zoom'])
                    ->where(['id' => $id])
                    ->first();

        $json = json_encode($latlng);
        $this->set(compact('json'));
    }
}
