<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Auth\AbstractPasswordHasher;

/**
 * ApiAuthen Controller
 *
 *
 * @method \App\Model\Entity\ApiAuthen[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApiAuthenController extends AppController {

    public $Users = null;
    public $Accesses = null;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
        $this->viewBuilder()->setLayout('ajax');

        $this->Users = TableRegistry::get('Users');
        $this->Accesses = TableRegistry::get('Accesses');
    }

    public function login() {
        $data = ['message' => '', 'status' => 400];

        if ($this->request->is(['post', 'ajax'])) {
            $postData = $this->request->getData();
            $this->log($postData,'debug');
            $isfacebook = isset($postData['isfacebook']) ? $postData['isfacebook'] : 'N';
            if ($isfacebook == 'N') {
                $email = isset($postData['email']) ? $postData['email'] : '';
                $password = isset($postData['password']) ? $postData['password'] : '';
                //$this->log($postData, 'debug');
                if ($email != '' && $password != '') {
                    $user = $this->Auth->identify();
                    if ($user) {
                        $q = $this->Users->find()
                                ->where(['Users.email' => $email])
                                ->limit(1);
                        $user = $q->first();
                        //$this->log($user,'debug');
                        $verifyCode = $this->Util->generateRandomString(20);
                        $access = $this->Accesses->newEntity();
                        $access->user_id = $user->id;
                        $access->verifycode = $verifyCode;
                        $this->Accesses->save($access);



                        $data['status'] = 200;
                        $data['user'] = $user;
                        $data['verifycode'] = $access->verifycode;
                    } else {
                        $data['message'] = "incorrect username and password.";
                    }
                } else {
                    $data['message'] = "username and password can't be empty.";
                }
            } else {
                $name = $postData['name'];
                $facebookid = $postData['facebookid'];
                $user = $this->Users->find()->where(['id'=>$facebookid])->first();

                if (is_null($user)) {
                    $user = $this->Users->newEntity();
                    $user->id = $facebookid;
                    $user->firstname = $name;
                    $user->lastname = ' ';
                    $this->Users->save($user);
                }
                
                $this->Auth->setUser($user);
                $verifyCode = $this->Util->generateRandomString(20);
                $access = $this->Accesses->newEntity();
                $access->user_id = $user->id;
                $access->verifycode = $verifyCode;
                $this->Accesses->save($access);



                $data['status'] = 200;
                $data['user'] = $user;
                $data['verifycode'] = $access->verifycode;
            }
        } else {
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function forgot() {
        $data = ['message' => '', 'status' => 400];

        if ($this->request->is(['post', 'ajax'])) {
            $postData = $this->request->getData();
            $email = isset($postData['email']) ? $postData['email'] : '';
            //$this->log($email, 'debug');
            if ($email != '') {
                $user = $this->Users->find()
                        ->where(['email' => $email])
                        ->first();
                if (!is_null($user)) {
                    $newPassword = $this->Util->generateRandomString();
                    $user->password = $newPassword;
                    $this->Users->save($user);
                    $data['status'] = 200;

                    //send email
                    $htmlEmailMsg = sprintf('<h3>เรึยน คุณ%s</h3><br/>', $user->firstname);
                    $htmlEmailMsg .= '<p>ตามที่ท่านได้กดลืมรหัสผ่าน จากเว็บ mapcii ระบบขอแจ้งรหัสผ่านใหม่ดังนี้</p>';
                    $htmlEmailMsg .= '<p>รหัสผ่านใหม่: ' . $newPassword . '</p>';

                    $sending = $this->Sendemail->testsend($user->email, 'แจ้งการกำหนดรหัสผ่านใหม่สำหรับ www.mapcii.com', $htmlEmailMsg);
                }
            } else {
                $data['message'] = "email  can't be empty.";
            }
        } else {
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function changepassword() {
        $data = ['message' => '', 'status' => 400];

        if ($this->request->is(['post', 'ajax'])) {
            $postData = $this->request->getData();
            $email = isset($postData['email']) ? $postData['email'] : '';
            $code = isset($postData['code']) ? $postData['code'] : '';
            //$this->log($email, 'debug');
            if ($email != '' && $code != '') {
                $data['status'] = 200;
                $data['email'] = $email;
                $data['code'] = $code;
            } else {
                $data['message'] = "email and code can't be empty.";
            }
        } else {
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function ischangepassword() { // new changepassword from frontend
        $data = ['message' => '', 'status' => 400];

        if ($this->request->is(['post', 'ajax'])) {
            $postData = $this->request->getData();
            $id = isset($postData['id']) ? $postData['id'] : '';
            $oldpass = isset($postData['old']) ? $postData['old'] : '';
            $newpass = isset($postData['new']) ? $postData['new'] : '';
            $user = $this->Users->find()
                        ->where(['id' => $id])
                        ->first();
                if (!is_null($user)) {
                    $checkOldPassword = DefaultPasswordHasher::check($oldpass, $user->password);
                    $this->log($checkOldPassword, 'debug');
                    if($checkOldPassword){
                        $user->password = $newpass;
                        $this->Users->save($user);
                        $data['status'] = 200;
                    }else{
                        $data['status'] = 400;
                        $data['message'] = 'Old Password Not incorrect.';
                    }
                }
        } else {
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

    public function accountActivate() {
        $email = $this->request->getQuery('email');
        $code = $this->request->getQuery('code');

        $q = $this->Users->find()
                ->where(['Users.email' => $email, 'Users.verifycode' => $code]);
        $user = $q->first();
        if (!is_null($user)) {
            $user->isverify = 'Y';
            $user->isactive = 'Y';
            $this->Users->save($user);
        }
    }

}
