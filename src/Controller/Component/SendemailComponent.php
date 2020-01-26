<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;

/**
 * Sendemail component
 */
class SendemailComponent extends Component {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $emailConfig = null;
    public $TRANSPORT_NAME = 'custommail';

    public function setMailConfig() {
        //EmailTransport

        $this->EmailSettings = TableRegistry::get('EmailSettings');
        $this->emailConfig = $this->EmailSettings->get('0');

        Email::dropTransport($this->TRANSPORT_NAME);
        Email::setConfigTransport($this->TRANSPORT_NAME, [
            'host' => $this->emailConfig->email_server,
            'port' => $this->emailConfig->email_port,
            'username' => $this->emailConfig->email_username,
            'password' => $this->emailConfig->email_password,
            'className' => 'Smtp',
            'tls' => false
        ]);
       // debug($this->emailConfig);
    }
    
    public function send($to,$title,$htmlMsg){
        $this->setMailConfig();
        $email = new Email();
        $email
                ->setTransport($this->TRANSPORT_NAME)
                ->setSubject($title)
                ->setTemplate('default', 'default')
                ->setEmailFormat('html')
                ->setTo($to)
                ->setFrom($this->emailConfig['email_address'])
                ->setViewVars(['content' => $msg]);
        if ($email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function testsend($to, $title, $msg) {
        $this->setMailConfig();
        $email = new Email();
        $email
                ->setTransport($this->TRANSPORT_NAME)
                ->setSubject($title)
                ->setTemplate('sendmail', 'default')
                ->setEmailFormat('html')
                ->setTo($to)
                ->setFrom($this->emailConfig['email_address'])
                ->setViewVars(['content' => $msg]);
        if ($email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function userForgotPassword($to = null, $link = '') {
        if (is_null($to) || $to == '') {
            return false;
        }

        $this->setMailConfig();


        $email = new Email();
        $email
                ->setTransport($this->TRANSPORT_NAME)
                ->setSubject('Forgot password')
                ->setTemplate('sentpassword', 'default')
                ->setEmailFormat('html')
                ->setTo($to)
                ->setFrom($this->emailConfig['email_address'])
                ->setViewVars(['link' => $link]);
        if ($email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function userRegisterWithPassword($to = null, $fullname = '', $password = '') {
        if (is_null($to) || $to == '') {
            return false;
        }

        $this->setMailConfig();

        $email = new Email();
        $email
                ->transport($this->TRANSPORT_NAME)
                ->subject('Registered successfully')
                ->template('user_register_with_password', 'default')
                ->emailFormat('html')
                ->to($to)
                ->from($this->emailConfig['email_address'])
                ->viewVars(['to' => $to, 'password' => $password, 'fullname' => $fullname]);
        if ($email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function bookingDetail($to = null,$bookingData = null) {
        if (is_null($to) || $to == '' || is_null($bookingData) || $bookingData =='') {
            return false;
        }

        $this->setMailConfig();

        $email = new Email();
        $email
                ->transport($this->TRANSPORT_NAME)
                ->subject('Your booking detail')
                ->template('booking_detail', 'default')
                ->emailFormat('html')
                ->to($to)
                ->from($this->emailConfig['email_address'])
                ->viewVars(['to' => $to, 'bookingData' => $bookingData]);
        if ($email->send()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function bookingDetailAdmin($bookingData = null) {
       
        $this->setMailConfig();
        $to = 'samuicleaner@gmail.com';
        //$to = 'clashpop@gmail.com';
        $email = new Email();
        $email
                ->transport($this->TRANSPORT_NAME)
                ->subject('New booking detail from customer')
                ->template('booking_detail_admin', 'default')
                ->emailFormat('html')
                ->to($to)
                ->from($this->emailConfig['email_address'])
                ->viewVars(['to' => $to, 'bookingData' => $bookingData]);
        if ($email->send()) {
            return true;
        } else {
            return false;
        }
    }

}
