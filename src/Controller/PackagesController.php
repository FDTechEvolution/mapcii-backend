<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
/**
 * Packages Controller
 *
 * @property \App\Model\Table\PackagesTable $Packages
 *
 * @method \App\Model\Entity\Package[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PackagesController extends AppController {

    public $UserPackages = null;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->UserPackages = TableRegistry::get('UserPackages');
        $this->Sizes = TableRegistry::get('Sizes');
        $this->Positions = TableRegistry::get('Positions');
    }
    public function index() {
      
        $packages = $this->Packages->find('all')
                    ->contain(['Sizes']);
        $this->set(compact('packages'));
    }

    /**
     * View method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $package = $this->Packages->get($id, [
            'contain' => ['Sizes']
        ]);

        $this->set('package', $package);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $package = $this->Packages->newEntity();
        if ($this->request->is('post')) {
            $package = $this->Packages->patchEntity($package, $this->request->getData());
            if ($this->Packages->save($package)) {
                $this->Flash->success(__('The package has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package could not be saved. Please, try again.'));
        }
        $this->set(compact('package'));

        $sizes = $this->Sizes->find('all');
        $this->set(compact('sizes'));

        $positions = $this->Positions->find('all');
        $this->set(compact('positions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $package = $this->Packages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $package = $this->Packages->patchEntity($package, $this->request->getData());
            if ($this->Packages->save($package)) {
                $this->Flash->success(__('The package has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package could not be saved. Please, try again.'));
        }
        $this->set(compact('package'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $package = $this->Packages->get($id);
        $q = $this->UserPackages->find()
                ->where(['package_id' => $id])
                ->first();
        if (sizeof($q) > 0) {
            $this->Flash->error(__('The package in use could not be deleted.'));
        } else {
              if ($this->Packages->delete($package)) {
            $this->Flash->success(__('The package has been deleted.'));
        } else {
            $this->Flash->error(__('The package could not be deleted. Please, try again.'));
        }
        }

     

        return $this->redirect(['action' => 'index']);
    }

}
