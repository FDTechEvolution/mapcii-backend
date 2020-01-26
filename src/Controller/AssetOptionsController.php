<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssetOptions Controller
 *
 * @property \App\Model\Table\AssetOptionsTable $AssetOptions
 *
 * @method \App\Model\Entity\AssetOption[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssetOptionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Assets', 'Options']
        ];
        $assetOptions = $this->paginate($this->AssetOptions);

        $this->set(compact('assetOptions'));
    }

    /**
     * View method
     *
     * @param string|null $id Asset Option id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assetOption = $this->AssetOptions->get($id, [
            'contain' => ['Assets', 'Options']
        ]);

        $this->set('assetOption', $assetOption);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assetOption = $this->AssetOptions->newEntity();
        if ($this->request->is('post')) {
            $assetOption = $this->AssetOptions->patchEntity($assetOption, $this->request->getData());
            if ($this->AssetOptions->save($assetOption)) {
                $this->Flash->success(__('The asset option has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The asset option could not be saved. Please, try again.'));
        }
        $assets = $this->AssetOptions->Assets->find('list', ['limit' => 200]);
        $options = $this->AssetOptions->Options->find('list', ['limit' => 200]);
        $this->set(compact('assetOption', 'assets', 'options'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Asset Option id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assetOption = $this->AssetOptions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assetOption = $this->AssetOptions->patchEntity($assetOption, $this->request->getData());
            if ($this->AssetOptions->save($assetOption)) {
                $this->Flash->success(__('The asset option has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The asset option could not be saved. Please, try again.'));
        }
        $assets = $this->AssetOptions->Assets->find('list', ['limit' => 200]);
        $options = $this->AssetOptions->Options->find('list', ['limit' => 200]);
        $this->set(compact('assetOption', 'assets', 'options'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Asset Option id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assetOption = $this->AssetOptions->get($id);
        if ($this->AssetOptions->delete($assetOption)) {
            $this->Flash->success(__('The asset option has been deleted.'));
        } else {
            $this->Flash->error(__('The asset option could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
