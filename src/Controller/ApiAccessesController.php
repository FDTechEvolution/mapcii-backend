<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
/**
 * ApiAccesses Controller
 *
 *
 * @method \App\Model\Entity\ApiAccess[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApiAccessesController extends AppController {
    
    public $Accesses = null;
    public $Users = null;
    
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
        $this->viewBuilder()->setLayout('ajax');

        $this->Accesses = TableRegistry::get('Accesses');
        $this->Users = TableRegistry::get('Users');

    }
    
    public function verify(){
        $data = ['message' => '', 'status' => 400];
        if($this->request->is(['post','ajax'])){
            $postData = $this->request->getData();
            
            $q = $this->Accesses->find()
                    ->contain(['Users'])
                    ->where(['Accesses.user_id'=>$postData['user_id'],'Accesses.verifycode'=>$postData['verifycode']])
                    ->limit(1);
            $access = $q->first();
            if(!is_null($access)){
                $data['access'] = $access;
                $data['status'] = 200;
            }
        }
        
        $json = json_encode($data);
        $this->set(compact('json'));
    }
    
    public function facebook(){
        $data = ['message' => '', 'status' => 400];
        if($this->request->is(['post','ajax'])){
            $postData = $this->request->getData();
            
            $q = $this->Users->find()
                    ->where(['Users.id'=>$postData['id']]);
            $user = $q->first();
            if(is_null($user)){
                
            }else{
                
            }
        }
        
        $json = json_encode($data);
        $this->set(compact('json'));
    }
   
}
