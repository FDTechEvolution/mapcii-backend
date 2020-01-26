<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;

/**
 * Login Controller
 *
 *
 * @method \App\Model\Entity\Login[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LoginController extends AppController {

    public $Users = null;
    public $SystemUsages = null;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Users = TableRegistry::get('Users');
        $this->SystemUsages = TableRegistry::get('SystemUsages');
    }

    public function index() {
        $this->viewBuilder()->setLayout('login');

        $urlName = env('SERVER_NAME');
        //if ($_SERVER['REQUEST_SCHEME'] == 'http' || (!$this->startsWith($urlName, 'www') && $urlName != '127.0.0.1')) {
        //return $this->redirect('https://' . env('SERVER_NAME') . $this->request->here);
        //return $this->redirect(SITE_URL);
        //}
        //Check if already login
        if (!(is_null($this->request->getSession()->read('Auth.User')))) {
            return $this->redirect(DEFAULT_HOME_URL);
        }


        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $user = $this->Auth->identify();

            //Check when already login in other client
//            $q = $this->SystemUsages->find()
//                    ->where(['SystemUsages.user_id' => $user['id'], 'SystemUsages.isactive' => 'Y']);
//            $loginDataCount = $q->count();
//            if ($loginDataCount > 0) {
            //$this->Flash->error('Account นี้กำลังใช้งานอยู่ไม่สามารถใช้งานซ้ำได้');
            //return $this->redirect(['controller'=>'logout']);
            //    }
            //end


            if ($user) {
                $user = $this->Users->get($user['id'], ['contain' => []]);

                if ($user->iscustomer == 'N') {
                    $this->Auth->setUser($user);
                    $this->Flash->success(__('Login สำเร็จ'));
                    return $this->redirect(DEFAULT_HOME_URL);
                } else {
                    $this->Flash->error(__('Space for Adimin only!!'));
                    return $this->redirect(['controller' => 'login']);
                }

              
            } else {
                $this->Flash->error(__('Invalid email or password, try again'));
                return $this->redirect(['controller' => 'login']);
            }
        }
    }

    public function verifyclient($user_id = null) {
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $systemUse = $this->SystemUsages->newEntity();
            $systemUse->user_id = $user_id;
            $systemUse->ipaddress = $data['ip'];
            $systemUse->isactive = 'Y';
            $description = $data['address'] . '[ ' . $data['lat'] . ',' . $data['long'] . ']';
            $systemUse->description = $description;
            $result = $this->SystemUsages->save($systemUse);
            if ($result) {
                $this->request->session()->write('SystemUsages.id', $systemUse->id);
                //return $systemUse->id;
                return $this->redirect(DEFAULT_HOME_URL);
            }
        }
    }

    private function startsWith($haystack, $needle) {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    private function endsWith($haystack, $needle) {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }
    }

    public function recoverpw() {
        $this->viewBuilder()->setLayout('login');
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $q = $this->Users->find()
                    ->where(['email' => $data['email']])
                    ->first();
            if ($q != '') {
                $newpass = $this->Util->generateRandomString();
                $q->verifycode = $newpass;
                // $this->log($q, 'debug');
                if ($this->Users->save($q)) {
                    $this->sentpassword($newpass, $q->email);
                }
            }
            $this->Flash->success(__('หาก email นั้นถูกต้องเราได้ส่ง email หาคุณแล้ว'));
        }
    }

    public function resetpassword() {
        $this->viewBuilder()->setLayout('login');
        $code = $_GET['code'];
        $email = $_GET['email'];
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $q = $this->Users->find()
                    ->where(['email' => $email, 'verifycode' => $code])
                    ->first();
            if ($q != '') {

                $q->password = $data['cpassword'];
                // $this->log($q, 'debug');
                if ($this->Users->save($q)) {
                    $this->Flash->success(__('ตั้งรหัสผ่านใหม่เรียบร้อย'));
                    return $this->redirect(['controller' => 'login']);
                }
            } else {
                $this->Flash->success(__('รหัสยืนยันไม่ถูกต้อง'));
                return $this->redirect(['controller' => 'login']);
            }
        }
    }

    public function sentpassword($codepass = null, $mail = null) {

        $link = SITE_URL . 'login/resetpassword?code=' . $codepass . '&email=' . $mail;
        $this->Sendemail->userForgotPassword($mail, $link);
        $this->set(compact('date', 'link'));
        $this->set('_serialize', ['link']);
    }

}
