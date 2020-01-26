<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

/**
 * Description of Utils
 *
 * @author sakorn.s
 */
class SequentComponent extends Component {

    public $SequentNumbers = null;

    public function getNextSequent() {
        $this->SequentNumbers = TableRegistry::get('SequentNumbers');
        $docSequent = $this->SequentNumbers->get('0');

        $documentNo = sprintf("%'.0" . $docSequent->running_length . "d", ($docSequent->current_no + 1));
        $documentNo = $docSequent->prefix . $documentNo;

        $docSequent->current_no = $docSequent->current_no + 1;
        $docSequent->current_sequent = $documentNo;
        $this->SequentNumbers->save($docSequent);
        
        return $documentNo;
    }

}
