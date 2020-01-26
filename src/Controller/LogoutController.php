<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Logout Controller
 *
 *
 * @method \App\Model\Entity\Logout[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LogoutController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->loadModel('SystemUsages');
        $id = $this->request->getSession()->read('SystemUsages.id');
        if (!is_null($id)) {
            $q = $this->SystemUsages->find()
                    ->where(['id' => $id])
                    ->limit(1);
            $system = $q->toArray();
            
            if (sizeof($system) !=0) {
                $system = $system[0];
                $system->isactive = 'N';
                $this->SystemUsages->save($system);
            }
        }

        $this->request->getSession()->destroy();
        return $this->redirect($this->Auth->logout());
    }
    
    public function endsession(){
        $this->viewBuilder()->layout('ajax');
        //$this->log('hi','debug');
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $this->log($data,'debug');
        }
    }

}
