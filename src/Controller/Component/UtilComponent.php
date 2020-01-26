<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class UtilComponent extends Component {

    public function convertDate($date = null) {
        if(is_null($date) || $date == ''){
            return null;
        }
        // $this->log('$date '.$date,'debug');
        $ext = explode('/', $date);
        // $this->log('$date '.$ext,'debug');
        $converted = ($ext[2]) . '-' . $ext[1] . '-' . $ext[0];
        //   $this->log('$converted '.$converted,'debug');
        return $converted;
    }

  
     public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
