<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssetImages Controller
 *
 * @property \App\Model\Table\AssetImagesTable $AssetImages
 *
 * @method \App\Model\Entity\AssetImage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssetImagesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Assets', 'Images']
        ];
        $assetImages = $this->paginate($this->AssetImages);

        $this->set(compact('assetImages'));
    }

    /**
     * View method
     *
     * @param string|null $id Asset Image id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assetImage = $this->AssetImages->get($id, [
            'contain' => ['Assets', 'Images']
        ]);

        $this->set('assetImage', $assetImage);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assetImage = $this->AssetImages->newEntity();
        if ($this->request->is('post')) {
            $assetImage = $this->AssetImages->patchEntity($assetImage, $this->request->getData());
            if ($this->AssetImages->save($assetImage)) {
                $this->Flash->success(__('The asset image has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The asset image could not be saved. Please, try again.'));
        }
        $assets = $this->AssetImages->Assets->find('list', ['limit' => 200]);
        $images = $this->AssetImages->Images->find('list', ['limit' => 200]);
        $this->set(compact('assetImage', 'assets', 'images'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Asset Image id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assetImage = $this->AssetImages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assetImage = $this->AssetImages->patchEntity($assetImage, $this->request->getData());
            if ($this->AssetImages->save($assetImage)) {
                $this->Flash->success(__('The asset image has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The asset image could not be saved. Please, try again.'));
        }
        $assets = $this->AssetImages->Assets->find('list', ['limit' => 200]);
        $images = $this->AssetImages->Images->find('list', ['limit' => 200]);
        $this->set(compact('assetImage', 'assets', 'images'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Asset Image id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assetImage = $this->AssetImages->get($id);
        if ($this->AssetImages->delete($assetImage)) {
            $this->Flash->success(__('The asset image has been deleted.'));
        } else {
            $this->Flash->error(__('The asset image could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
