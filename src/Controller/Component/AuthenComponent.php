<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\Component;

use Cake\Controller\Component;

/**
 * Description of Utils
 *
 * @author sakorn.s
 */
class AuthenComponent extends Component {

    public function authen() {
        $control = strtolower($this->request->getParam('controller'));
        $action = strtolower($this->request->getParam('action'));


        if ($this->authenPublicFunction($control, $action)) {
           // $this->log('1', 'debug');
            return true;
        }

        if ((is_null($this->request->getSession()->read('Auth.User')))) {
          //  $this->log('2', 'debug');
            return false;
        } else {
          //  $this->log('3', 'debug');
            $Permissions = $this->request->getSession()->read('rolePermissions');
//            $this->log($control, 'debug');
//            $this->log($Permissions, 'debug');
            if (in_array($control, $Permissions['controller'])) {
             //   $this->log('4', 'debug');
                $actionArr = $Permissions['actions'][$control];
                //$this->log($actionArr, 'debug');

                if ($action == 'displaypermission' || $action == 'logout') {
                //    $this->log('5', 'debug');
                    return true;
                } elseif (in_array($action, $actionArr)) {
              //      $this->log('6', 'debug');
                    return true;
                } else {
             //       $this->log('7', 'debug');
                    return false;
                }
            } else {
            //    $this->log('8', 'debug');
                return false;
            }
        }
    }

    public function getAuthenUserId() {
        $user_id = $this->request->getSession()->read('Auth.User.id');
        if (is_null($user_id) || $user_id == '') {
            $user_id = '0';
        }
        return $user_id;
    }

    private function authenPublicFunction($control, $action) {


        $allows = [
            'systemusages' => ['verifysession'],
            'login' => ['index', 'verifyclient', 'forgotpass'],
            'logout' => ['index'],
            'invoices' => ['view', 'getdetailjson'],
            'productions' => ['getdetailjson'],
            'plantgroups'=>['saverow','updateposition'],
            'users' => ['displaypermission'],
            'scmanagements' => [],
            'services' => [],
            'registformulas'=>['getdetailjson'],
            'rawmattransactions' => ['getdetailjson','getdetailproductionjson','savetransaction','deltransaction','edittransaction'],
            'qrcode' => [],
            'tvc'=>['ajaxformulacalaulation','ajaxtvccalaulation','ajaxgenkeycode','ajaxgetformulawithcalaulation']
        ];

        if ((isset($allows[$control]) == true) && (in_array($action, $allows[$control]) || sizeof($allows[$control]) == 0)) {

            return true;
        } else {
            //$this->log($action,'debug');
            return false;
            //return $this->redirect(['controller' => 'login', 'action' => 'index']);
        }
    }

}
