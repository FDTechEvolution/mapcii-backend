<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Assets Controller
 *
 * @property \App\Model\Table\AssetsTable $Assets
 *
 * @method \App\Model\Entity\Asset[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssetsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {

        $q = $this->Assets->find()
                ->contain(['AssetTypes' => 'AssetCategories', 'Users', 'Addresses'])
                ->order(['Assets.created' => 'ASC']);
        $assets = $q->toArray();
        //  $this->log($assets, 'debug');
        $this->set(compact('assets'));
    }
    
    public function approveRequest(){
        $q = $this->Assets->find()
                ->contain(['AssetTypes' => 'AssetCategories', 'Users', 'Addresses'])
                ->where(['Assets.status'=>'WT'])
                ->order(['Assets.created' => 'ASC']);
        $assets = $q->toArray();
        //  $this->log($assets, 'debug');
        $this->set(compact('assets'));
    }
    
    public function approve($asset_id = null){
        $asset = $this->Assets->get($asset_id);
        $asset->status = 'CO';
        $asset->isactive = 'Y';
        $this->Assets->save($asset);
        
        return $this->redirect(['action'=>'approve-request']);
    }

    /**
     * View method
     *
     * @param string|null $id Asset id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $asset = $this->Assets->get($id, [
            'contain' => ['AssetTypes', 'Users', 'Addresses', 'AssetImages', 'AssetOptions']
        ]);

        $this->set('asset', $asset);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $asset = $this->Assets->newEntity();
        if ($this->request->is('post')) {
            $asset = $this->Assets->patchEntity($asset, $this->request->getData());
            if ($this->Assets->save($asset)) {
                $this->Flash->success(__('The asset has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The asset could not be saved. Please, try again.'));
        }
        $assetTypes = $this->Assets->AssetTypes->find('list', ['limit' => 200]);
        $users = $this->Assets->Users->find('list', ['limit' => 200]);
        $addresses = $this->Assets->Addresses->find('list', ['limit' => 200]);
        $this->set(compact('asset', 'assetTypes', 'users', 'addresses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Asset id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $asset = $this->Assets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $asset = $this->Assets->patchEntity($asset, $this->request->getData());
            if ($this->Assets->save($asset)) {
                $this->Flash->success(__('The asset has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The asset could not be saved. Please, try again.'));
        }
        $assetTypes = $this->Assets->AssetTypes->find('list', ['limit' => 200]);
        $users = $this->Assets->Users->find('list', ['limit' => 200]);
        $addresses = $this->Assets->Addresses->find('list', ['limit' => 200]);
        $this->set(compact('asset', 'assetTypes', 'users', 'addresses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Asset id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $asset = $this->Assets->get($id);
        if ($this->Assets->delete($asset)) {
            $this->Flash->success(__('The asset has been deleted.'));
        } else {
            $this->Flash->error(__('The asset could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function saveactive() {


        $this->autoRender = false;

        $id = $this->request->getQuery('id');

        $asset = $this->Assets->get($id);

        if ($asset->isactive == 'Y') {
            $asset->isactive = "N";
        } else {
            $asset->isactive = "Y";
        }
        if ($this->Assets->save($asset)) {
            echo json_encode('Success');
            $this->Flash->success(__('Success.'));
        }else{
            $this->Flash->error(__('Error.'));
            echo json_encode('Error');
        }
        
    }

}
