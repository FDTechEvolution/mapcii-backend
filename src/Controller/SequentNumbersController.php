<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SequentNumbers Controller
 *
 * @property \App\Model\Table\SequentNumbersTable $SequentNumbers
 *
 * @method \App\Model\Entity\SequentNumber[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SequentNumbersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $sequentNumbers = $this->paginate($this->SequentNumbers);

        $this->set(compact('sequentNumbers'));
    }

    /**
     * View method
     *
     * @param string|null $id Sequent Number id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sequentNumber = $this->SequentNumbers->get($id, [
            'contain' => []
        ]);

        $this->set('sequentNumber', $sequentNumber);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sequentNumber = $this->SequentNumbers->newEntity();
        if ($this->request->is('post')) {
            $sequentNumber = $this->SequentNumbers->patchEntity($sequentNumber, $this->request->getData());
            if ($this->SequentNumbers->save($sequentNumber)) {
                $this->Flash->success(__('The sequent number has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sequent number could not be saved. Please, try again.'));
        }
        $this->set(compact('sequentNumber'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sequent Number id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sequentNumber = $this->SequentNumbers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sequentNumber = $this->SequentNumbers->patchEntity($sequentNumber, $this->request->getData());
            if ($this->SequentNumbers->save($sequentNumber)) {
                $this->Flash->success(__('The sequent number has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sequent number could not be saved. Please, try again.'));
        }
        $this->set(compact('sequentNumber'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sequent Number id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sequentNumber = $this->SequentNumbers->get($id);
        if ($this->SequentNumbers->delete($sequentNumber)) {
            $this->Flash->success(__('The sequent number has been deleted.'));
        } else {
            $this->Flash->error(__('The sequent number could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
