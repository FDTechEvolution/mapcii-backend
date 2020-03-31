<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PackageTypes Controller
 *
 * @property \App\Model\Table\PackageTypesTable $PackageTypes
 *
 * @method \App\Model\Entity\PackageType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PackageTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $packageTypes = $this->paginate($this->PackageTypes);

        $this->set(compact('packageTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Package Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $packageType = $this->PackageTypes->get($id, [
            'contain' => ['Packages']
        ]);

        $this->set('packageType', $packageType);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $packageType = $this->PackageTypes->newEntity();
        if ($this->request->is('post')) {
            $packageType = $this->PackageTypes->patchEntity($packageType, $this->request->getData());
            if ($this->PackageTypes->save($packageType)) {
                $this->Flash->success(__('The package type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package type could not be saved. Please, try again.'));
        }
        $this->set(compact('packageType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Package Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $packageType = $this->PackageTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $packageType = $this->PackageTypes->patchEntity($packageType, $this->request->getData());
            if ($this->PackageTypes->save($packageType)) {
                $this->Flash->success(__('The package type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package type could not be saved. Please, try again.'));
        }
        $this->set(compact('packageType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Package Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $packageType = $this->PackageTypes->get($id);
        if ($this->PackageTypes->delete($packageType)) {
            $this->Flash->success(__('The package type has been deleted.'));
        } else {
            $this->Flash->error(__('The package type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
