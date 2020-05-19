<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * Notification component
 */
class NotificationComponent extends Component
{
    
    public function getNoificationPayment($id = null) {
        $this->PaymentLines = TableRegistry::get('payment_lines');
        $notification = $this->PaymentLines->find()
                        ->where(['payment_id' => $id, 'status' => 'DR'])
                        ->first();
        if(isset($notification)){
            $notice = 1;
        }else{
            $notice = '';
        }
        return $notice;
    }

    public function getNoificationPaymentCount() {
        $this->PaymentLines = TableRegistry::get('payment_lines');
        $notifications = $this->PaymentLines->find()
                        ->where(['status' => 'DR'])
                        ->toArray();
        foreach($notifications as $notification) {
            $notice = count($notification);
        }
        return $notice;
    }

    public function getNoificationBanner($id = null) {
        $this->BannerLines = TableRegistry::get('banner_lines');
        $notification = $this->BannerLines->find()
                        ->where(['banner_id' => $id, 'isactive' => 'N'])
                        ->first();
        if(isset($notification)){
            $notice = 1;
        }else{
            $notice = '';
        }
        return $notice;
    }
}
