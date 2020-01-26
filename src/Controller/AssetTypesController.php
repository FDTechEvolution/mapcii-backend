<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * AssetTypes Controller
 *
 * @property \App\Model\Table\AssetTypesTable $AssetTypes
 *
 * @method \App\Model\Entity\AssetType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssetTypesController extends AppController {

    public $Assets = null;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);



        $this->Assets = TableRegistry::get('Assets');
    }

    public function index($cate_id = null) {
        $this->viewBuilder()->setLayout('clean');
        $q = $this->AssetTypes->find()
                ->contain(['Images', 'AssetCategories'])
                ->where(['AssetTypes.asset_category_id' => $cate_id])
                ->order(['AssetTypes.name' => 'ASC']);
        $assetTypes = $q->toArray();
//        $this->paginate = [
//            'contain' => ['Images', 'AssetCategories']
//        ];
//        $assetTypes = $this->paginate($this->AssetTypes);

        $this->set(compact('assetTypes', 'cate_id'));
    }

    /**
     * View method
     *
     * @param string|null $id Asset Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $assetType = $this->AssetTypes->get($id, [
            'contain' => ['Images', 'AssetCategories', 'Assets']
        ]);

        $this->set('assetType', $assetType);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($cate_id = null) {
        $this->viewBuilder()->setLayout('clean');
        $assetType = $this->AssetTypes->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $this->log($assetType, 'debug');
            $assetType = $this->AssetTypes->patchEntity($assetType, $data);
            $assetType->asset_category_id = $cate_id;
            if ($this->AssetTypes->save($assetType)) {
                $this->Flash->success(__('The asset type has been saved.'));

                return $this->redirect(['action' => 'index', $cate_id]);
            }
            $this->Flash->error(__('The asset type could not be saved. Please, try again.'));
        }
        $images = $this->AssetTypes->Images->find('list', ['limit' => 200]);
        $assetCategories = $this->Core->getassetcate();
        $this->set(compact('assetType', 'assetCategories', 'cate_id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Asset Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->viewBuilder()->setLayout('clean');
        $assetType = $this->AssetTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assetType = $this->AssetTypes->patchEntity($assetType, $this->request->getData());
            if ($this->AssetTypes->save($assetType)) {
                $this->Flash->success(__('The asset type has been saved.'));

                return $this->redirect(['action' => 'index', $assetType->asset_category_id]);
            }
            $this->Flash->error(__('The asset type could not be saved. Please, try again.'));
        }
        $images = $this->AssetTypes->Images->find('list', ['limit' => 200]);
        $assetCategories = $this->AssetTypes->AssetCategories->find('list', ['limit' => 200]);
        $this->set(compact('assetType', 'images', 'assetCategories', 'cate_id'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Asset Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $assetType = $this->AssetTypes->get($id);
        $q = $this->Assets->find()
                ->where(['asset_type_id' => $id])
                ->first();
        if (sizeof($q) > 0) {
            $this->Flash->error(__('The asset type in use could not be deleted.'));
        } else {
            if ($this->AssetTypes->delete($assetType)) {
                $this->Flash->success(__('The asset type has been deleted.'));
            } else {
                $this->Flash->error(__('The asset type could not be deleted. Please, try again.'));
            }
        }



        return $this->redirect(['action' => 'index', $assetType->asset_category_id]);
    }

}
