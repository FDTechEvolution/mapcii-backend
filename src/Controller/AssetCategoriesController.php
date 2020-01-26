<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
/**
 * AssetCategories Controller
 *
 * @property \App\Model\Table\AssetCategoriesTable $AssetCategories
 *
 * @method \App\Model\Entity\AssetCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssetCategoriesController extends AppController {

   public $AssetTypes = null;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
      

       
        $this->AssetTypes = TableRegistry::get('AssetTypes');
        
    }
    public function index() {
        $assetCategories = $this->paginate($this->AssetCategories);

        $this->set(compact('assetCategories'));
    }

    /**
     * View method
     *
     * @param string|null $id Asset Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $assetCategory = $this->AssetCategories->get($id, [
            'contain' => ['AssetTypes']
        ]);

        $this->set('assetCategory', $assetCategory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $assetCategory = $this->AssetCategories->newEntity();
        if ($this->request->is('post')) {
            $assetCategory = $this->AssetCategories->patchEntity($assetCategory, $this->request->getData());
            if ($this->AssetCategories->save($assetCategory)) {
                $this->Flash->success(__('The asset category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The asset category could not be saved. Please, try again.'));
        }
        $this->set(compact('assetCategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Asset Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $assetCategory = $this->AssetCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assetCategory = $this->AssetCategories->patchEntity($assetCategory, $this->request->getData());
            if ($this->AssetCategories->save($assetCategory)) {
                $this->Flash->success(__('The asset category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The asset category could not be saved. Please, try again.'));
        }
        $this->set(compact('assetCategory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Asset Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $assetCategory = $this->AssetCategories->get($id);
        $q = $this->AssetTypes->find()
                ->where(['asset_category_id' => $id])
                ->first();
       
        if (sizeof($q) > 0) {
            $this->Flash->error(__('The asset category in use could not be deleted.'));
        } else {
            if ($this->AssetCategories->delete($assetCategory)) {
                $this->Flash->success(__('The asset category has been deleted.'));
            } else {
                $this->Flash->error(__('The asset category could not be deleted. Please, try again.'));
            }

            
        }
        return $this->redirect(['action' => 'index']);
    }

}
