<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PackageDurations Controller
 *
 * @property \App\Model\Table\PackageDurationsTable $PackageDurations
 *
 * @method \App\Model\Entity\PackageDuration[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PackageDurationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $packageDurations = $this->paginate($this->PackageDurations);

        $this->set(compact('packageDurations'));
    }

    /**
     * View method
     *
     * @param string|null $id Package Duration id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $packageDuration = $this->PackageDurations->get($id, [
            'contain' => []
        ]);

        $this->set('packageDuration', $packageDuration);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $packageDuration = $this->PackageDurations->newEntity();
        if ($this->request->is('post')) {
            $packageDuration = $this->PackageDurations->patchEntity($packageDuration, $this->request->getData());
            if ($this->PackageDurations->save($packageDuration)) {
                $this->Flash->success(__('The package duration has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package duration could not be saved. Please, try again.'));
        }
        $this->set(compact('packageDuration'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Package Duration id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $packageDuration = $this->PackageDurations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $packageDuration = $this->PackageDurations->patchEntity($packageDuration, $this->request->getData());
            if ($this->PackageDurations->save($packageDuration)) {
                $this->Flash->success(__('The package duration has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package duration could not be saved. Please, try again.'));
        }
        $this->set(compact('packageDuration'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Package Duration id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $packageDuration = $this->PackageDurations->get($id);
        if ($this->PackageDurations->delete($packageDuration)) {
            $this->Flash->success(__('The package duration has been deleted.'));
        } else {
            $this->Flash->error(__('The package duration could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
