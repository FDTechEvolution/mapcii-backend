<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Subdistricts Controller
 *
 * @property \App\Model\Table\SubdistrictsTable $Subdistricts
 *
 * @method \App\Model\Entity\Subdistrict[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubdistrictsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Districts']
        ];
        $subdistricts = $this->paginate($this->Subdistricts);

        $this->set(compact('subdistricts'));
    }

    /**
     * View method
     *
     * @param string|null $id Subdistrict id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subdistrict = $this->Subdistricts->get($id, [
            'contain' => ['Districts', 'Addresses']
        ]);

        $this->set('subdistrict', $subdistrict);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subdistrict = $this->Subdistricts->newEntity();
        if ($this->request->is('post')) {
            $subdistrict = $this->Subdistricts->patchEntity($subdistrict, $this->request->getData());
            if ($this->Subdistricts->save($subdistrict)) {
                $this->Flash->success(__('The subdistrict has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subdistrict could not be saved. Please, try again.'));
        }
        $districts = $this->Subdistricts->Districts->find('list', ['limit' => 200]);
        $this->set(compact('subdistrict', 'districts'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Subdistrict id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subdistrict = $this->Subdistricts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subdistrict = $this->Subdistricts->patchEntity($subdistrict, $this->request->getData());
            if ($this->Subdistricts->save($subdistrict)) {
                $this->Flash->success(__('The subdistrict has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subdistrict could not be saved. Please, try again.'));
        }
        $districts = $this->Subdistricts->Districts->find('list', ['limit' => 200]);
        $this->set(compact('subdistrict', 'districts'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Subdistrict id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subdistrict = $this->Subdistricts->get($id);
        if ($this->Subdistricts->delete($subdistrict)) {
            $this->Flash->success(__('The subdistrict has been deleted.'));
        } else {
            $this->Flash->error(__('The subdistrict could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
