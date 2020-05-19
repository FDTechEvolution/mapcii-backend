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
class ApiUsersController extends AppController {

    public $Users = null;
    public $UserFavorites = null;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
        $this->viewBuilder()->setLayout('ajax');

        $this->Users = TableRegistry::get('Users');
    }

    public function register() {
        $data = ['message' => '', 'status' => 400];
        $user = $this->Users->newEntity();
        if ($this->request->is(['post', 'ajax'])) {
            $postData = $this->request->getData();
            $firstname = isset($postData['firstname']) ? $postData['firstname'] : '';
            $lastname = isset($postData['lastname']) ? $postData['lastname'] : '';

            if ($firstname != '' && $lastname != '') {
                $user = $this->Users->patchEntity($user, $postData);
                $user->verifycode = $this->Util->generateRandomString(20);
                if ($this->Users->save($user)) {
                    $data['status'] = 200;
                    $data['message'] = "Register success.";

                    //send email
                    $htmlEmailMsg = sprintf('<h3>เรึยน คุณ%s</h3><br/>', $user->firstname);
                    $htmlEmailMsg .= '<p>ขอบคุณที่ลงทะเบียนใช้งานเว็บไซต์ MapCii อีเมลที่คุณลงทะเบียนไว้คือ ' . $user->email . '</p>';
                    $htmlEmailMsg .= '<p>กรุณาคลิกลิงก์เพื่อยืนยันอีเมลของคุณ</p>';
                    $activateButton = sprintf('<p><a href="%saccount-activate?email=%s&code=%s">ยืนยัน</a></p>', 'https://www.mapcii.com/', $user->email, $user->verifycode);
                    $htmlEmailMsg .= $activateButton;

                    $sending = $this->Sendemail->testsend($user->email, 'ยืนยันการสมัครสมาชิก', $htmlEmailMsg);
                } else {
                    //$this->log($user->errors(),'debug');
                    $data['status'] = 400;
                    $data['message'] = "ไม่สามารถบันทึกได้ email นี้ใช้ไปแล้วหรืออาจมีข้อมูลบางอย่างผิดพลาด";
                }
            } else {
                $data['message'] = "firstname and lastname can't be empty.";
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


            $memberid = isset($id) ? $id : '';
            if ($memberid != '') {
                $user = $this->Users->get($id, [
                    'contain' => []
                ]);
                $postData = $this->request->getData();
                $firstname = isset($postData['firstname']) ? $postData['firstname'] : '';
                $lastname = isset($postData['lastname']) ? $postData['lastname'] : '';

                if ($firstname != '' && $lastname != '') {
                    $user = $this->Users->patchEntity($user, $postData);
                    if ($this->Users->save($user)) {
                        $data['status'] = 200;
                        $data['message'] = "Updated success.";
                    } else {
                        $data['status'] = 400;
                        $data['message'] = "could not be Updated.";
                    }
                } else {
                    $data['message'] = "firstname and lastname can't be empty.";
                }
            } else {
                $data['message'] = "Member id can't be empty.";
            }
        } else {
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function user() {
        $data = ['message' => '', 'status' => 400, 'data' => []];

        $id = $this->request->getQuery('id');
        $user = $this->Users->find()->where(['id' => $id])->first();
        if (!is_null($user)) {
            $data['data'] = $user;
            $data['status'] = 200;
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function assetFavorite() {
        $this->UserFavorites = TableRegistry::get('UserFavorites');

        $data = ['message' => '', 'status' => 400, 'data' => []];

        //  $this->log($this->request->getQueryParams(),'debug');
        $assetId = $this->request->getQuery('asset_id');
        $userId = $this->request->getQuery('user_id');
        
       
        if (!is_null($userId) && $userId != '' && !is_null($assetId) && $assetId != '') {
            $userFavorite = $this->UserFavorites->find()
                            ->where(['user_id' => $userId, 'asset_id' => $assetId])->first();
            if(is_null($userFavorite)){
                $userFavorite = $this->UserFavorites->newEntity();
                $userFavorite->user_id = $userId;
                $userFavorite->asset_id = $assetId;
                $userFavorite->isactive = 'Y';
                
                $this->UserFavorites->save($userFavorite);
                
            }else{
                if($userFavorite->isactive =='Y'){
                    $userFavorite->isactive = 'N';
                }else{
                    $userFavorite->isactive = 'Y';
                }
                $this->UserFavorites->save($userFavorite);
            }
            $data['status'] = 200;
        }
        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function autoUnblockUser () {
        if ($this->request->is(['post', 'ajax'])) {
            $postData = $this->request->getData();
            $date = date("Y-m-d");
            $users = $this->Users->find()->where(['islocked' => 'Y'])->toArray();
            if(sizeof($users) > 0) {
                foreach($users as $user) {
                    if($user->locktime == $date){
                        $user->islocked = 'N';
                        $this->Users->save($user);
                    }
                }
            }
        }
    }

}
