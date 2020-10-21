<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Sizes Controller
 *
 * @property \App\Model\Table\SizesTable $Sizes
 *
 * @method \App\Model\Entity\Size[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SizesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $sizes = $this->paginate($this->Sizes);

        $this->set(compact('sizes'));
    }

    /**
     * View method
     *
     * @param string|null $id Size id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $size = $this->Sizes->get($id, [
            'contain' => ['Packages']
        ]);

        $this->set('size', $size);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $size = $this->Sizes->newEntity();
        if ($this->request->is('post')) {
            $size = $this->Sizes->patchEntity($size, $this->request->getData());
            if ($this->Sizes->save($size)) {
                $this->Flash->success(__('The size has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The size could not be saved. Please, try again.'));
        }
        $this->set(compact('size'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Size id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $size = $this->Sizes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $size = $this->Sizes->patchEntity($size, $this->request->getData());
            if ($this->Sizes->save($size)) {
                $this->Flash->success(__('The size has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The size could not be saved. Please, try again.'));
        }
        $this->set(compact('size'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Size id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $size = $this->Sizes->get($id);
        if ($this->Sizes->delete($size)) {
            $this->Flash->success(__('The size has been deleted.'));
        } else {
            $this->Flash->error(__('The size could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
