<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserPackages Controller
 *
 * @property \App\Model\Table\UserPackagesTable $UserPackages
 *
 * @method \App\Model\Entity\UserPackage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserPackagesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Packages']
        ];
        $userPackages = $this->paginate($this->UserPackages);

        $this->set(compact('userPackages'));
    }

    /**
     * View method
     *
     * @param string|null $id User Package id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userPackage = $this->UserPackages->get($id, [
            'contain' => ['Users', 'Packages']
        ]);

        $this->set('userPackage', $userPackage);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userPackage = $this->UserPackages->newEntity();
        if ($this->request->is('post')) {
            $userPackage = $this->UserPackages->patchEntity($userPackage, $this->request->getData());
            if ($this->UserPackages->save($userPackage)) {
                $this->Flash->success(__('The user package has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user package could not be saved. Please, try again.'));
        }
        $users = $this->UserPackages->Users->find('list', ['limit' => 200]);
        $packages = $this->UserPackages->Packages->find('list', ['limit' => 200]);
        $this->set(compact('userPackage', 'users', 'packages'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User Package id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userPackage = $this->UserPackages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userPackage = $this->UserPackages->patchEntity($userPackage, $this->request->getData());
            if ($this->UserPackages->save($userPackage)) {
                $this->Flash->success(__('The user package has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user package could not be saved. Please, try again.'));
        }
        $users = $this->UserPackages->Users->find('list', ['limit' => 200]);
        $packages = $this->UserPackages->Packages->find('list', ['limit' => 200]);
        $this->set(compact('userPackage', 'users', 'packages'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User Package id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userPackage = $this->UserPackages->get($id);
        if ($this->UserPackages->delete($userPackage)) {
            $this->Flash->success(__('The user package has been deleted.'));
        } else {
            $this->Flash->error(__('The user package could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
