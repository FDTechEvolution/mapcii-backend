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
class ApiPackagesController extends AppController {

    public $Packages = null;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
        $this->viewBuilder()->setLayout('ajax');

        $this->Packages = TableRegistry::get('Packages');
    }

    public function listpackages() {
        $data = ['message' => '', 'status' => 400];

        if ($this->request->is(['get', 'ajax'])) {
            $getType = $this->request->getQuery('type');
            $getNewProject = $this->request->getQuery('newproject');
            $getSales = $this->request->getQuery('sales');
            $getRent = $this->request->getQuery('rest');

            $type = isset($getType)?(['PackageTypes.name' => $getType]):'';
            $newProject = ($getNewProject == 'Y')?(['Packages.name LIKE' => '%โครงการใหม่%']):'';
            $sales = ($getSales == 'Y')?(['Packages.name LIKE' => '%อสังหาขายด่วน%']):'';
            $rent = ($getRent == 'Y')?(['Packages.name LIKE' => '%อสังหามือสอง%']):'';

            $q = $this->Packages->find('all')
                ->contain(['Sizes','PackageTypes'])
                ->where([$type, $newProject, $sales, $rent])
                ->order(['Packages.created' => 'ASC']);
            $packages = $q->toArray();

            if (sizeof($packages) > 0) {
                $data['status'] = 200;
                $data['packagelist'] = $packages;
            } else {
                $data['message'] = "Packages is empty.";
            }
        } else {
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data,JSON_PRETTY_PRINT);
        $this->set(compact('json'));
        $this->set('_serialize', 'json');
    }

    public function packages() {
        $data = ['message' => '', 'status' => 400];
        $id = $this->request->getQuery('id');
        if ($this->request->is(['get', 'ajax'])) {
              $packageid = isset($id) ? $id : '';
            
            if ($packageid != '') {
                $q = $this->Packages->find()
                        ->where(['id' => $packageid])
                        ->first();
                
                $data['status'] = 200;
                $data['detail'] = $q;
            } else {
                $data['message'] = "Package id is empty.";
            }
        } else {
            $data['message'] = "incorrect method.";
        }

        $json = json_encode($data);
        $this->set(compact('json'));
    }

}
