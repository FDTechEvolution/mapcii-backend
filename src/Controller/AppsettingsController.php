<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Appsettings Controller
 *
 * @property \App\Model\Table\AppsettingsTable $Appsettings
 *
 * @method \App\Model\Entity\Appsetting[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AppsettingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $appsettings = $this->paginate($this->Appsettings);

        $this->set(compact('appsettings'));
    }

    /**
     * View method
     *
     * @param string|null $id Appsetting id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $appsetting = $this->Appsettings->get($id, [
            'contain' => []
        ]);

        $this->set('appsetting', $appsetting);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $appsetting = $this->Appsettings->newEntity();
        if ($this->request->is('post')) {
            $appsetting = $this->Appsettings->patchEntity($appsetting, $this->request->getData());
            if ($this->Appsettings->save($appsetting)) {
                $this->Flash->success(__('The appsetting has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The appsetting could not be saved. Please, try again.'));
        }
        $this->set(compact('appsetting'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Appsetting id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $appsetting = $this->Appsettings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $appsetting = $this->Appsettings->patchEntity($appsetting, $this->request->getData());
            if ($this->Appsettings->save($appsetting)) {
                $this->Flash->success(__('The appsetting has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The appsetting could not be saved. Please, try again.'));
        }
        $this->set(compact('appsetting'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Appsetting id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $appsetting = $this->Appsettings->get($id);
        if ($this->Appsettings->delete($appsetting)) {
            $this->Flash->success(__('The appsetting has been deleted.'));
        } else {
            $this->Flash->error(__('The appsetting could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
